@extends('principal')
@section('titulo')
    REGISTRO CARRERA
@endsection
@section('contenido')
<div class="content-body">
    <div class="container">
        <div class="row">
            <div class="row">
                <div class="col-xxl-12 col-xl-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <a href="{{ route('cc_reporte_pdf', ['id'=>encryp_rodry($id_d)]) }}" class="btn btn-danger m-2" >PDF</a>
                            <!-- Aquí mostramos la hora -->
                            <div class="text-right">
                                <span id="reloj" style="font-size: 3rem; font-weight: bold; color: #000;"></span>
                            </div>

                            <button type="button" class="btn btn-primary m-2" data-toggle="modal" data-target="#nuevo_registro_modal">INICIAR CARRERA</button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-responsive" id="listar_persona_registro_tabla" style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th rowspan="2">#</th>
                                            <th rowspan="2">NUMERO</th>
                                            <th rowspan="2">COMUNIDAD</th>
                                            <th rowspan="2">NOMBRES Y APELLIDOS</th>
                                            <th colspan="2" class="text-center" >PRIMERA CARRERA</th>
                                            <th colspan="2" class="text-center">SEGUNDA CARRERA</th>
                                        </tr>
                                        <tr>
                                            <th>Inicio</th>
                                            <th>Finalizar</th>
                                            <th>Inicio</th>
                                            <th>Finalizar</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Nuevo -->
<div class="modal fade" id="nuevo_registro_modal" data-bs-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">REGISTRAR NUEVA CARRERA</h5>
                <button type="button" class="btn-close"  data-dismiss="modal" aria-label="Close" onclick="input_borrar_registro()"></button>
            </div>
            <div class="modal-body">
                <form method="POST" id="form_new_registro" class="identity-upload">
                    @csrf
                    <div class="row g-3">
                        <input type="hidden" id="id_carrera" name="id_carrera" value="{{ $id_d }}">
                        <input type="hidden" id="id_persona" name="id_persona">
                        <div class="col-xl-12">
                            <label class="form-label">INGRESE NUMERO DE PARTICIPANTE</label>
                            <input type="text" class="form-control" id="numero" name="numero" placeholder="Ingrese numero de participante" onkeyup="validar_numero(this.value)">
                        </div>
                        <div id="existe_no" class="text-center"></div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close" onclick="input_borrar_registro()">Cerrar</button>
                <button type="button" id="btn_guardar_inicio" class="btn btn-primary" disabled>Iniciar</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script>
        let id_carrera = {{ $id_d }};

        function input_borrar_registro(){
            document.getElementById("form_new_registro").reset();
            document.getElementById('existe_no').innerHTML = '';
        }


        //para validar numnero
        async function validar_numero(numero){
            let valor_valido = document.getElementById("existe_no");
            //para el boton
            let boton_iniciar = document.getElementById("btn_guardar_inicio");
            //para recuperar el id
            let id_persona = document.getElementById('id_persona');
            if(numero.length > 1){
                try {
                let respuesta = await fetch("{{ route('cc_validar_ci')  }}", {
                    method:'POST',
                    headers:{
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token
                    },
                    body: JSON.stringify({numero:numero, id_carrera:id_carrera})
                });
                let dato = await respuesta.json();
                if(dato.tipo==='success'){
                    valor_valido.innerHTML = `<p id="success_color" >existe el registro</p>`;
                    boton_iniciar.disabled = false;
                    id_persona.value = dato.mensaje.id;
                }
                if(dato.tipo==='error'){
                    valor_valido.innerHTML = `<p id="error_color" >`+dato.mensaje+`</p>`;
                    boton_iniciar.disabled = true;
                    id_persona.value = '';
                }
            } catch (error) {
                console.log('error', error.message);
                boton_iniciar.disabled = true;
                id_persona.value = '';
            }
            }else{
                valor_valido.innerHTML = `<p id="error_color" >debe ser mayor a 1 digito</p>`;
                boton_iniciar.disabled = true;
                id_persona.value = '';
            }
        }

        //para guardar registro de carrera
        let guardar_inicio_btn = document.getElementById('btn_guardar_inicio');
        guardar_inicio_btn.addEventListener('click', async ()=>{
            let datos = Object.fromEntries(new FormData(document.getElementById('form_new_registro')).entries());

            let valor_valido = document.getElementById("existe_no");
            //para el boton
            let boton_iniciar = document.getElementById("btn_guardar_inicio");
            //para recuperar el id
            let id_persona = document.getElementById('id_persona');

            try {
                let respuesta = await fetch("{{ route('cc_guardar_registro') }}", {
                    method:'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(datos)
                });
                let dato = await respuesta.json();
                input_borrar_registro();
                if(dato.tipo==='error'){
                    alerta_top(dato.tipo, dato.mensaje);
                    valor_valido.innerHTML = '';
                    boton_iniciar.disabled = true;
                    id_persona.value = '';
                }
                if(dato.tipo==='success'){
                    alerta_top(dato.tipo, dato.mensaje);
                    $('#listar_persona_registro_tabla').DataTable().destroy();
                    listar_personas_carrera();
                    //modal_editar_persona.hide();
                    valor_valido.innerHTML = ``;
                    boton_iniciar.disabled = true;
                    id_persona.value = '';
                }
            } catch (error) {
                console.log('ERROR'+error.message);
            }
        });

        //para imprimir la lista
        async function listar_personas_carrera(){
            try {
                let respuesta = await fetch("{{ route('cc_listar_registro_carrera') }}", {
                    method:'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token
                    },
                    body: JSON.stringify({id_carrera:id_carrera})
                });
                let dato = await respuesta.json();
                if(dato.tipo==='success'){
                    let i=1;
                    console.log(dato);
                    $("#listar_persona_registro_tabla").DataTable({
                        'data':dato.mensaje,
                        'columns':[
                            {"render":function(){
                                return a = i++;
                            }},
                            {'data':'persona.placa'},
                            {'data':'persona.comunidad'},
                            {"render":function(data, type, row, meta){
                                return `${row.persona.nombres_piloto} ${row.persona.ap_paterno_piloto}  ${row.persona.ap_materno_piloto}` + ` - `+`${row.persona.nombres_copiloto} ${row.persona.ap_paterno_copiloto}  ${row.persona.ap_materno_copiloto}`;
                            }},
                            {"render": function(data, type, row, meta){
                                if(row.inicio_primero !== null && row.fin_primero !== null){
                                    let a=`
                                        <div class="d-flex">
                                            <a href="javascript:void(0)" class="btn btn-primary shadow btn-xs sharp">
                                                finalizado
                                            </a>
                                        </div>
                                    `;
                                    return a;
                                }else{
                                    if(row.inicio_primero !== null){
                                        let a=`
                                            <div class="d-flex">
                                                <a href="javascript:void(0)" class="btn btn-success shadow btn-xs sharp">
                                                    Iniciado
                                                </a>
                                            </div>
                                        `;
                                        return a;
                                    }
                                }
                            }},

                            {"render": function(data, type, row, meta){

                                if(row.inicio_primero !== null && row.fin_primero !== null){
                                    let a=`
                                        <div class="d-flex">
                                            <a href="javascript:void(0)" class="btn btn-primary shadow btn-xs sharp">
                                                finalizado
                                            </a>
                                        </div>
                                    `;
                                    return a;
                                }else{
                                    let a=`
                                        <div class="d-flex">
                                            <a href="javascript:void(0)" class="btn btn-danger shadow btn-xs sharp" onclick="finalizar_primera_carrera('${row.id}')">
                                                Finalizar
                                            </a>
                                        </div>
                                    `;
                                    return a;
                                }

                            }},
                            {"render": function(data, type, row, meta){

                                if(row.inicio_segundo !== null && row.fin_segundo !== null){
                                    let a=`
                                        <div class="d-flex">
                                            <a href="javascript:void(0)" class="btn btn-primary btn-sm shadow btn-xs sharp">
                                                finalizado
                                            </a>
                                        </div>
                                    `;
                                    return a;
                                }else{
                                    if(row.inicio_segundo !== null){
                                        let a=`
                                            <div class="d-flex">
                                                <a href="javascript:void(0)" class="btn btn-success shadow btn-xs sharp">
                                                    Iniciado
                                                </a>
                                            </div>
                                        `;
                                        return a;
                                    }else{
                                        let a=`
                                            <div class="d-flex">
                                                <a href="javascript:void(0)" class="btn btn-warning btn-sm shadow btn-xs sharp" onclick="iniciar_segunda_carrera('${row.id}')">
                                                    Iniciar
                                                </a>
                                            </div>
                                        `;
                                        return a;
                                    }
                                }
                            }},
                            {"render": function(data, type, row, meta){

                                if(row.inicio_segundo !== null && row.fin_segundo !== null){
                                    let a=`
                                        <div class="d-flex">
                                            <a href="javascript:void(0)" class="btn btn-primary btn-sm shadow btn-xs sharp">
                                                finalizado
                                            </a>
                                        </div>
                                    `;
                                    return a;
                                }else{
                                    if(row.fin_segundo !== null){
                                        let a=`
                                            <div class="d-flex">
                                                <a href="javascript:void(0)" class="btn btn-success shadow btn-xs sharp">
                                                    Iniciado
                                                </a>
                                            </div>
                                        `;
                                        return a;
                                    }else{
                                        let a=`
                                            <div class="d-flex">
                                                <a href="javascript:void(0)" class="btn btn-danger btn-sm shadow btn-xs sharp" onclick="finalizar_segunda_carrera('${row.id}')">
                                                    Finalizar
                                                </a>
                                            </div>
                                        `;
                                        return a;
                                    }
                                }
                            }},
                        ]
                    });
                }else{
                    mostrar_mensajes(dato.tipo, dato.mensaje);
                }
            } catch (error) {
                console.log('Error: ' + error.message);
            }
        }
        listar_personas_carrera();


        async function finalizar_primera_carrera(id){
            try {
                let respuesta = await fetch("{{ route('cc_finalizar_primera_carrera') }}", {
                    method:'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token
                    },
                    body: JSON.stringify({id:id})
                });
                let dato = await respuesta.json();
                if(dato.tipo==='error'){
                    alerta_top(dato.tipo, dato.mensaje);
                }
                if(dato.tipo==='success'){
                    alerta_top(dato.tipo, dato.mensaje);
                    $('#listar_persona_registro_tabla').DataTable().destroy();
                    listar_personas_carrera();
                }
            } catch (error) {
                console.log('Error: ' + error.message);
            }
        }
        //para iniciar la segund carrera
        async function iniciar_segunda_carrera(id){
            try {
                let respuesta = await fetch("{{ route('cc_iniciar_segunda_carrera') }}", {
                    method:'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token
                    },
                    body: JSON.stringify({id:id})
                });
                let dato = await respuesta.json();
                if(dato.tipo==='error'){
                    alerta_top(dato.tipo, dato.mensaje);
                }
                if(dato.tipo==='success'){
                    alerta_top(dato.tipo, dato.mensaje);
                    $('#listar_persona_registro_tabla').DataTable().destroy();
                    listar_personas_carrera();
                }
            } catch (error) {
                console.log('Error: ' + error.message);
            }
        }
        async function finalizar_segunda_carrera(id) {
            try {
                let respuesta = await fetch("{{ route('cc_finalizar_segunda_carrera') }}", {
                    method:'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token
                    },
                    body: JSON.stringify({id:id})
                });
                let dato = await respuesta.json();
                if(dato.tipo==='error'){
                    alerta_top(dato.tipo, dato.mensaje);
                }
                if(dato.tipo==='success'){
                    alerta_top(dato.tipo, dato.mensaje);
                    $('#listar_persona_registro_tabla').DataTable().destroy();
                    listar_personas_carrera();
                }
            } catch (error) {
                console.log('Error: ' + error.message);
            }
        }

        function actualizarHora() {
            const ahora = new Date();

            // Formato: HH:mm:ss (24 horas)
            const horas = String(ahora.getHours()).padStart(2, '0');
            const minutos = String(ahora.getMinutes()).padStart(2, '0');
            const segundos = String(ahora.getSeconds()).padStart(2, '0');

            const horaFormateada = `${horas}:${minutos}:${segundos}`;
            document.getElementById("reloj").textContent = horaFormateada;
        }

        // Actualizar cada segundo
        setInterval(actualizarHora, 1000);

        // Llamar de inmediato al cargar
        actualizarHora();

    </script>
@endsection
