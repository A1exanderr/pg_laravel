@extends('principal')
@section('titulo')
    TIPO DE CARRERAS
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
                                <h3>Tipo</h3>
                            </div>
                        </div>
                        <div class="col-auto">
                            <div class="breadcrumbs">
                                <a href="#">Carrera</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xxl-12 col-xl-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Listado de carreras</h4>
                            <button type="button" class="btn btn-primary m-2" data-toggle="modal"
                                            data-target="#tipo_new_modal">Nuevo Registro</button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-responsive " style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>DESCRIPCIÓN</th>
                                            <th>FECHA REALIZACIÓN</th>
                                            <th>ACCIONES</th>
                                        </tr>
                                    </thead>
                                    <tbody id="listar_tipo_tab">
                                    </tbody>
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
<div class="modal fade" id="tipo_new_modal" data-bs-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Registrar la carrera</h5>
                <button type="button" class="btn-close"  data-dismiss="modal" aria-label="Close" onclick="input_vaciar_error_tipo()"></button>
            </div>
            <div class="modal-body">
                <form method="POST" id="form_new_tipo" class="identity-upload">
                    @csrf
                    <div class="row g-3">
                        <div class="col-xl-12">
                            <label class="form-label">DESCRIPCIÓN</label>
                            <textarea name="descripcion" id="descripcion" class="form-control" cols="10" rows="10"></textarea>
                            <div id="_descripcion"></div>
                        </div>
                        <div class="col-xl-12">
                            <label class="form-label">CI</label>
                            <input type="date" class="form-control" id="fecha_realizacion" name="fecha_realizacion">
                            <div id="_fecha_realizacion"></div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close" onclick="input_vaciar_error_tipo()">Cerrar</button>
                <button type="button" id="btn_guardar_tipo" class="btn btn-primary">Guardar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Editar -->
<div class="modal fade" id="tipo_edit_modal" data-bs-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar el tipo de carrera</h5>
                <button type="button" class="btn-close"  data-dismiss="modal" aria-label="Close" onclick="input_vaciar_error_tipo()"></button>
            </div>
            <div class="modal-body">
                <form method="POST" id="form_edit_tipo" class="identity-upload">
                    @csrf
                    <input type="text" name="id" id="id">
                    <div class="row g-3">
                        <div class="col-xl-12">
                            <label class="form-label">DESCRIPCIÓN</label>
                            <textarea name="descripcion_" id="descripcion_" class="form-control" cols="10" rows="10"></textarea>
                            <div id="_descripcion_"></div>
                        </div>
                        <div class="col-xl-12">
                            <label class="form-label">CI</label>
                            <input type="date" class="form-control" id="fecha_realizacion_" name="fecha_realizacion_">
                            <div id="_fecha_realizacion_"></div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close" onclick="input_vaciar_error_tipo()">Cerrar</button>
                <button type="button" id="btn_guardar_tipo_edit" class="btn btn-primary">Guardar</button>
            </div>
        </div>
    </div>
</div>

@endsection
@section('scripts')
    <script>
        //para modal
        let modal_nuevo_tipo = new bootstrap.Modal(document.getElementById('tipo_new_modal'), {
            keyboard: false
        });
        //para guardar el tipo
        let guardar_tipo_btn = document.getElementById('btn_guardar_tipo');
        guardar_tipo_btn.addEventListener('click', async()=>{
            let datos = Object.fromEntries(new FormData(document.getElementById('form_new_tipo')).entries());
            try {
                let respuesta = await fetch("{{ route('tc_guardar') }}", {
                    method:'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(datos)
                });
                let dato = await respuesta.json();
                console.log(dato);
                vaciar_errores_tipo();
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
                    listar_tipo();
                    input_vaciar_error_tipo();
                    modal_nuevo_tipo.hide();
                }
            } catch (error) {
                console.log('ERROR'+error.message);
            }
        });

        //para eliminar _errores de personas
        function vaciar_errores_tipo(){
            document.getElementById('_descripcion').innerHTML        =   "";
            document.getElementById('_fecha_realizacion').innerHTML  =   "";

            document.getElementById('_descripcion_').innerHTML        =   "";
            document.getElementById('_fecha_realizacion_').innerHTML  =   "";
        }

        function input_vaciar_error_tipo(){
            vaciar_errores_tipo();
            document.getElementById('form_new_tipo').reset();

            //document.getElementById('form_edit_persona').reset();
        }

        //para listar tipo
        async function listar_tipo(){
            try {
                let respuesta = await fetch("{{ route('tc_listar') }}", {
                    method:'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token
                    },
                });
                let dato = await respuesta.json();
                if(dato.tipo==='success'){
                    let i = 1;
                    let datos = dato.mensaje;
                    let cuerpo = "";
                    for(let key in datos){
                        cuerpo += '<tr>';
                        cuerpo += '<td>'+ i++ +'</td>';
                        cuerpo += '<td>'+ datos[key]['descripcion'] +'</td>';
                        cuerpo += '<td>'+ datos[key]['fecha_realizacion'] +'</td>';
                        cuerpo += `<td>
                            <div class="d-flex">
                                <a href="#" class="btn btn-primary btn-sm shadow btn-xs sharp me-1" onclick="editar_tipo('${datos[key]['id']}')">
                                    <i class="fa fa-pencil"></i>
                                </a>
                                <a href="#" class="btn btn-danger shadow btn-xs sharp" onclick="eliminar_tipo('${datos[key]['id']}')">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </div>
                        </td>`;
                        cuerpo += '</tr>';
                    }
                    document.getElementById('listar_tipo_tab').innerHTML =cuerpo;
                }else{
                    alerta_top(dato.tipo, dato.mensaje);
                }
            } catch (error) {
                console.log('Error: ' + error.message);
            }
        }
        listar_tipo();

        //para modal
        let modal_editar_tipo = new bootstrap.Modal(document.getElementById('tipo_edit_modal'), {
            keyboard: false
        });

        //para editar el registro del tipoi
        async function editar_tipo(id){
            try {
                let respuesta = await fetch("{{ route('tc_editar')  }}", {
                    method:'POST',
                    headers:{
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token
                    },
                    body: JSON.stringify({id:id})
                });
                let dato = await respuesta.json();
                modal_editar_tipo.show();
                if(dato.tipo==='success'){
                document.getElementById('id').value = dato.mensaje.id;
                document.getElementById('descripcion_').value = dato.mensaje.descripcion;
                document.getElementById('fecha_realizacion_').value = dato.mensaje.fecha_realizacion;
                }
                if(dato.tipo==='error'){
                    alerta_top(dato.tipo, dato.mensaje);
                }
            } catch (error) {
                console.log('error', error.message);
            }
        }
        //para guardar todo lo editado
        let guardar_tipo_edit_btn = document.getElementById('btn_guardar_tipo_edit');
        guardar_tipo_edit_btn.addEventListener('click', async ()=>{
            let datos = Object.fromEntries(new FormData(document.getElementById('form_edit_tipo')).entries());
            try {
                let respuesta = await fetch("{{ route('tc_guardar_e') }}", {
                    method:'PUT',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(datos)
                });
                let dato = await respuesta.json();
                console.log(dato);
                vaciar_errores_tipo();
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
                    listar_tipo();
                    input_vaciar_error_tipo();
                    modal_editar_tipo.hide();
                }
            } catch (error) {
                console.log('ERROR'+error.message);
            }
        });
        //para eliminar el registro
        async function eliminar_tipo(id){
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
                        let respuesta = await fetch("{{ route('tc_eliminar') }}",{
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
                            listar_tipo();
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
    </script>
@endsection
