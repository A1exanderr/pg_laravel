@extends('principal')
@section('titulo')
    REGISTRO DE PERSONAS
@endsection
@section('contenido')

<div class="content-body">
    <div class="container">
        <div class="row">
            <div class="col-xxl-12">
                <div class="page-title">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-xl-4">
                            <div class="page-title-content">
                                <h3>Personas</h3>
                            </div>
                        </div>
                        <div class="col-auto">
                            <div class="breadcrumbs">
                                <a href="#">Personas</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xxl-12 col-xl-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Listado de personas</h4>
                            <button type="button" class="btn btn-primary m-2" data-toggle="modal"
                                            data-target="#persona_new_modal">Nuevo Registro</button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-responsive " id="listar_persona_tab" style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th rowspan="2">#</th>
                                            <th rowspan="2">NUMERO</th>
                                            <th rowspan="2">COMUNIDAD</th>
                                            <th colspan="2" class="text-center" >PILOTO</th>
                                            <th colspan="2" class="text-center" >COPILOTO</th>
                                            <th rowspan="2">ACCIONES</th>
                                        </tr>
                                        <tr>
                                            <th>NOMBRES</th>
                                            <th>APELLIDOS</th>
                                            <th>NOMBRES</th>
                                            <th>APELLIDOS</th>
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
<div class="modal fade" id="persona_new_modal" data-bs-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Registrar nueva Persona</h5>
                <button type="button" class="btn-close"  data-dismiss="modal" aria-label="Close" onclick="inputs_formulario_nuevo_persona()"></button>
            </div>
            <div class="modal-body">
                <form method="POST" id="form_new_persona" class="identity-upload">
                    @csrf
                    <div class="row g-3">
                        <div class="col-xl-12">
                            <label class="form-label">NUMERO DEL COMPETIDOR</label>
                            <input type="text" class="form-control" id="numero_competidor" name="numero_competidor" placeholder="Ingrese el numero de competidor">
                            <div id="_numero_competidor"></div>
                        </div>
                        <div class="col-xl-12">
                            <label class="form-label">NOMBRE DE LA COMUNIDAD</label>
                            <input type="text" class="form-control" id="comunidad" name="comunidad" placeholder="Ingres nombre de la comunidad">
                            <div id="_comunidad"></div>
                        </div>
                        <div class="col-xl-12">
                            <label class="form-label">NOMBRES DEL PILOTO</label>
                            <input type="text" class="form-control" id="nombres_piloto" name="nombres_piloto" placeholder="Nombres del piloto">
                            <div id="_nombres_piloto"></div>
                        </div>
                        <div class="col-xl-12">
                            <label class="form-label">APELLIDO PATERNO DEL PILOTO</label>
                            <input type="text" class="form-control" id="apellido_paterno_piloto" name="apellido_paterno_piloto" placeholder="Apellido del piloto">
                            <div id="_apellido_paterno_piloto"></div>
                        </div>
                        <div class="col-xl-12">
                            <label class="form-label">APELLIDO MATERNO DEL PILOTO </label>
                            <input type="text" class="form-control" id="apellido_materno_piloto" name="apellido_materno_piloto" placeholder="Apellido del piloto">
                            <div id="_apellido_materno_piloto"></div>
                        </div>

                        <div class="col-xl-12">
                            <label class="form-label">NOMBRES DEL COPILOTO</label>
                            <input type="text" class="form-control" id="nombres_copiloto" name="nombres_copiloto" placeholder="Nombres del copiloto">
                            <div id="_nombres_copiloto"></div>
                        </div>
                        <div class="col-xl-12">
                            <label class="form-label">APELLIDO PATERNO DEL COPILOTO</label>
                            <input type="text" class="form-control" id="apellido_paterno_copiloto" name="apellido_paterno_copiloto" placeholder="Apellido del copiloto">
                            <div id="_apellido_paterno_copiloto"></div>
                        </div>
                        <div class="col-xl-12">
                            <label class="form-label">APELLIDO MATERNO DEL PILOTO </label>
                            <input type="text" class="form-control" id="apellido_materno_copiloto" name="apellido_materno_copiloto" placeholder="Apellido del copiloto">
                            <div id="_apellido_materno_copiloto"></div>
                        </div>

                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close" onclick="inputs_formulario_nuevo_persona()">Cerrar</button>
                <button type="button" id="btn_guardar_new_persona" class="btn btn-primary">Guardar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Editar -->
<div class="modal fade" id="persona_edit_modal" data-bs-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Persona</h5>
                <button type="button" class="btn-close"  data-dismiss="modal" aria-label="Close" onclick="inputs_formulario_nuevo_persona()"></button>
            </div>
            <div class="modal-body">
                <form method="POST" id="form_edit_persona" class="identity-upload">
                    @csrf
                    <input type="text" name="id" id="id">
                    <div class="row g-3">
                        <div class="col-xl-12">
                            <label class="form-label">NUMERO DEL COMPETIDOR</label>
                            <input type="text" class="form-control" id="numero_competidor_" name="numero_competidor_" placeholder="Ingrese el numero de competidor">
                            <div id="_numero_competidor_"></div>
                        </div>
                        <div class="col-xl-12">
                            <label class="form-label">NOMBRE DE LA COMUNIDAD</label>
                            <input type="text" class="form-control" id="comunidad_" name="comunidad_" placeholder="Ingres nombre de la comunidad">
                            <div id="_comunidad_"></div>
                        </div>
                        <div class="col-xl-12">
                            <label class="form-label">NOMBRES DEL PILOTO</label>
                            <input type="text" class="form-control" id="nombres_piloto_" name="nombres_piloto_" placeholder="Nombres del piloto">
                            <div id="_nombres_piloto_"></div>
                        </div>
                        <div class="col-xl-12">
                            <label class="form-label">APELLIDO PATERNO DEL PILOTO</label>
                            <input type="text" class="form-control" id="apellido_paterno_piloto_" name="apellido_paterno_piloto_" placeholder="Apellido del piloto">
                            <div id="_apellido_paterno_piloto_"></div>
                        </div>
                        <div class="col-xl-12">
                            <label class="form-label">APELLIDO MATERNO DEL PILOTO </label>
                            <input type="text" class="form-control" id="apellido_materno_piloto_" name="apellido_materno_piloto_" placeholder="Apellido del piloto">
                            <div id="_apellido_materno_piloto_"></div>
                        </div>

                        <div class="col-xl-12">
                            <label class="form-label">NOMBRES DEL COPILOTO</label>
                            <input type="text" class="form-control" id="nombres_copiloto_" name="nombres_copiloto_" placeholder="Nombres del copiloto">
                            <div id="_nombres_copiloto_"></div>
                        </div>
                        <div class="col-xl-12">
                            <label class="form-label">APELLIDO PATERNO DEL COPILOTO</label>
                            <input type="text" class="form-control" id="apellido_paterno_copiloto_" name="apellido_paterno_copiloto_" placeholder="Apellido del copiloto">
                            <div id="_apellido_paterno_copiloto_"></div>
                        </div>
                        <div class="col-xl-12">
                            <label class="form-label">APELLIDO MATERNO DEL PILOTO </label>
                            <input type="text" class="form-control" id="apellido_materno_copiloto_" name="apellido_materno_copiloto_" placeholder="Apellido del copiloto">
                            <div id="_apellido_materno_copiloto_"></div>
                        </div>

                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close" onclick="inputs_formulario_nuevo_persona()">Cerrar</button>
                <button type="button" id="btn_guardar_editar_persona" class="btn btn-primary">Guardar</button>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
    <script>

        //para guardar persona
        let modal_nuevo_persona = new bootstrap.Modal(document.getElementById('persona_new_modal'), {
            keyboard: false
        });

        let guardar_new_persona = document.getElementById('btn_guardar_new_persona');
        guardar_new_persona.addEventListener('click', async ()=>{
            let datos = Object.fromEntries(new FormData(document.getElementById('form_new_persona')).entries());
            try {
                let respuesta = await fetch("{{ route('pc_guardar') }}", {
                    method:'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(datos)
                });
                let dato = await respuesta.json();
                console.log(dato);
                vaciar_errores_personas();
                if(dato.tipo==='errores'){
                    let obj = dato.mensaje;
                    for (let key in obj) {
                        document.getElementById('_'+key).innerHTML = `<p id="error_color" >`+obj[key]+`</p>`;
                    }
                }
                if(dato.tipo==='error'){
                    alerta_top(dato.tipo, dato.mensaje);
                }
                if(dato.tipo==='success'){
                    alerta_top(dato.tipo, dato.mensaje);
                    $('#listar_persona_tab').DataTable().destroy();
                    listar_personas();
                    inputs_formulario_nuevo_persona();
                    //modal_nuevo_persona.hide();
                }
            } catch (error) {
                console.log('ERROR'+error.message);
            }
        });
        //para eliminar _errores de personas
        function vaciar_errores_personas(){
            document.getElementById('_numero_competidor').innerHTML         =   "";
            document.getElementById('_comunidad').innerHTML                 =   "";
            document.getElementById('_nombres_piloto').innerHTML            =   "";
            document.getElementById('_apellido_paterno_piloto').innerHTML   =   "";
            document.getElementById('_apellido_materno_piloto').innerHTML   =   "";
            document.getElementById('_nombres_copiloto').innerHTML          =   "";
            document.getElementById('_apellido_paterno_copiloto').innerHTML =   "";
            document.getElementById('_apellido_materno_copiloto').innerHTML =   "";

            document.getElementById('_numero_competidor_').innerHTML         =   "";
            document.getElementById('_comunidad_').innerHTML                 =   "";
            document.getElementById('_nombres_piloto_').innerHTML            =   "";
            document.getElementById('_apellido_paterno_piloto_').innerHTML   =   "";
            document.getElementById('_apellido_materno_piloto_').innerHTML   =   "";
            document.getElementById('_nombres_copiloto_').innerHTML          =   "";
            document.getElementById('_apellido_paterno_copiloto_').innerHTML =   "";
            document.getElementById('_apellido_materno_copiloto_').innerHTML =   "";
        }

        function inputs_formulario_nuevo_persona(){
            vaciar_errores_personas();
            document.getElementById('form_new_persona').reset();

            document.getElementById('form_edit_persona').reset();
        }


        //para listar personas
        async function listar_personas(){
            try {
                let respuesta = await fetch("{{ route('pc_listar') }}", {
                    method:'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token
                    },
                });
                let dato = await respuesta.json();
                if(dato.tipo==='success'){
                    let i=1;
                    $("#listar_persona_tab").DataTable({
                        'data':dato.mensaje,
                        'columns':[
                            {"render":function(){
                                return a = i++;
                            }},
                            {'data':'placa'},
                            {'data':'comunidad'},
                            {'data':'nombres_piloto'},
                            {"render":function(data, type, row, meta){
                                return `${row.ap_paterno_piloto }  ${row.ap_materno_piloto}`;

                            }},
                            {'data':'nombres_copiloto'},
                            {"render":function(data, type, row, meta){
                                return `${row.ap_paterno_copiloto }  ${row.ap_materno_copiloto}`;

                            }},
                            {"render": function(data, type, row, meta){
                                let a=`
                                    <div class="d-flex">
                                        <a href="javascript:void(0)" class="btn btn-primary btn-sm shadow btn-xs sharp me-1" onclick="editar_persona('${row.id}')">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        <a href="javascript:void(0)" class="btn btn-danger shadow btn-xs sharp" onclick="eliminar_persona('${row.id}')">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </div>
                                `;
                                return a;
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
        listar_personas();

        //para eliminar persona
        async function eliminar_persona(id){
            Swal.fire({
                title: 'NOTA!',
                text: "Estas seguro de eliminar?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, eliminar!',
                cancelButtonText: 'No, cancelar!',
            }).then(async (result) => {
                if (result.isConfirmed) {
                    try {
                        let respuesta = await fetch("{{ route('pc_eliminar') }}",{
                            method:"DELETE",
                            headers: {
                                'content-type': 'application/json',
                                'X-CSRF-TOKEN': token
                            },
                            body: JSON.stringify({id:id}),
                        });
                        let dato = await respuesta.json();
                        if(dato.tipo==='success'){
                            alerta_top(dato.tipo, dato.mensaje);
                            $('#listar_persona_tab').DataTable().destroy();
                            listar_personas();
                        }
                        if(dato.tipo==='error'){
                            alerta_top(dato.tipo, dato.mensaje);
                        }
                    } catch (error) {
                        console.log("Error en : "+error);
                    }
                }else{
                    alerta_top('error','Se cancelo');
                }
            })
        }

        //para editar persona
        let modal_editar_persona = new bootstrap.Modal(document.getElementById('persona_edit_modal'), {
            keyboard: false
        });

        async function editar_persona(id){
            try {
                let respuesta = await fetch("{{ route('pc_editar')  }}", {
                    method:'POST',
                    headers:{
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token
                    },
                    body: JSON.stringify({id:id})
                });
                let dato = await respuesta.json();
                modal_editar_persona.show();
                if(dato.tipo==='success'){
                document.getElementById('id').value = dato.mensaje.id;

                document.getElementById('numero_competidor_').value         =   dato.mensaje.placa;
                document.getElementById('comunidad_').value                 =   dato.mensaje.comunidad;
                document.getElementById('nombres_piloto_').value            =   dato.mensaje.nombres_piloto;
                document.getElementById('apellido_paterno_piloto_').value   =   dato.mensaje.ap_paterno_piloto;
                document.getElementById('apellido_materno_piloto_').value   =   dato.mensaje.ap_materno_piloto;
                document.getElementById('nombres_copiloto_').value          =   dato.mensaje.nombres_copiloto;
                document.getElementById('apellido_paterno_copiloto_').value =   dato.mensaje.ap_paterno_copiloto;
                document.getElementById('apellido_materno_copiloto_').value =   dato.mensaje.ap_materno_copiloto;
                }
                if(dato.tipo==='error'){
                    alerta_top(dato.tipo, dato.mensaje);
                }
            } catch (error) {
                console.log('error', error.message);
            }
        }
        //para guardar lo editado
        let guardar_editar_persona = document.getElementById('btn_guardar_editar_persona');
        guardar_editar_persona.addEventListener('click', async()=>{
            let datos = Object.fromEntries(new FormData(document.getElementById('form_edit_persona')).entries());
            try {
                let respuesta = await fetch("{{ route('pc_guardar_e') }}", {
                    method:'PUT',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(datos)
                });
                let dato = await respuesta.json();
                vaciar_errores_personas();
                if(dato.tipo==='errores'){
                    let obj = dato.mensaje;
                    for (let key in obj) {
                        document.getElementById('_'+key).innerHTML = `<p id="error_color" >`+obj[key]+`</p>`;
                    }
                }
                if(dato.tipo==='error'){
                    alerta_top(dato.tipo, dato.mensaje);
                }
                if(dato.tipo==='success'){
                    alerta_top(dato.tipo, dato.mensaje);
                    $('#listar_persona_tab').DataTable().destroy();
                    listar_personas();
                    modal_editar_persona.hide();
                }
            } catch (error) {
                console.log('ERROR'+error.message);
            }
        });
    </script>
@endsection
