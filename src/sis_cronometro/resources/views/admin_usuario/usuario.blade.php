@extends('principal')
@section('titulo')
    USUARIO
@endsection
@section('contenido')
    <div class="row">
        <div class="col-xl-12">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>Bienvenido {{ Auth::user()->nombres }}</h4>
                        <p class="mb-0">Administracion de usuarios</p>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <div class="welcome-text">
                        <h5>Usuarios</h5>
                    </div>
                </div>
            </div>
            <div class="filter cm-content-box box-primary">
                <div class="content-title">
                    <div class="cpa">
                        <i class="fa fa-list-alt me-1"></i>LISTADO DE USUARIOS
                    </div>
                    <div class="tools">
                        <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#basicModal">Nuevo Usuario</button>
                    </div>
                </div>
                <div class="cm-content-body form excerpt">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="display table table-responsive table-sm" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>CI</th>
                                                <th>NOMBRES</th>
                                                <th>APELLIDOS</th>
                                                <th>CELULAR</th>
                                                <th>ESTADO</th>
                                                <th>EMAIL</th>
                                                <th>OPCIONES</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($listar_usuarios as $lis)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $lis->ci }}</td>
                                                    <td>{{ $lis->nombres }}</td>
                                                    <td>{{ $lis->apellido_paterno.' '.$lis->apellido_materno }}</td>
                                                    <td>{{ $lis->celular }}</td>
                                                    <td>
                                                        <span class="badge rounded-pill bg-success">{{ $lis->estado }}</span>
                                                    </td>
                                                    <td>{{ $lis->email }}</td>
                                                    <td>
                                                        <div class="d-flex">
                                                            <a href="#" class="btn btn-warning shadow btn-xs sharp me-1" onclick="editar_usuario('{{ $lis->id }}')">
                                                                <i class="fa fa-pencil"></i>
                                                            </a>
                                                            <a href="#" class="btn btn-danger shadow btn-xs sharp" onclick="eliminar_usuario('{{ $lis->id }}')">
                                                                <i class="fa fa-trash"></i>
                                                            </a>
                                                            <a href="#" class="btn btn-primary shadow btn-xs sharp" onclick="reset_usuario('{{ $lis->id }}')">
                                                                <i class="fa fa-unlock-alt"></i>
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
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
    {{-- nuevo usuario --}}
    <div class="modal fade" id="basicModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Nuevo Usuario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="limpiar_campos_new()"></button>
                </div>
                <div class="modal-body">
                    <form method="post" id="form_usuario" class="formularios_des" autocomplete="off">
                        @csrf
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">CI</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control input-rounded" name="ci" id="ci" placeholder="Ingrese numero de carnet" onkeyup="validar_ci(this.value)">
                                <div id="_ci" ></div>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Nombres</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control input-rounded" name="nombres" id="nombres" placeholder="Ingrese nombres" @disabled(true)>
                                <div id="_nombres" ></div>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Apellido Paterno</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control input-rounded" name="apellido_paterno" id="apellido_paterno" placeholder="Ingrese el apellido paterno" @disabled(true)>
                                <div id="_apellido_paterno" ></div>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Apellido Materno</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control input-rounded" name="apellido_materno" id="apellido_materno" placeholder="Ingrese el apellido materno" @disabled(true)>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <div class="col-sm-6">
                                <label for="">Usuario</label>
                                <input type="text" class="form-control input-rounded" name="usuario" id="usuario" placeholder="Generar usuario" @disabled(true)>
                                <div id="_usuario" ></div>
                            </div>
                            <div class="col-sm-6">
                                <label for="">Contraseña</label>
                                <input type="text" class="form-control input-rounded" name="password" id="password" placeholder="Generar contraseña" @disabled(true)>
                                <div id="_password" ></div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger light btn-sm" data-bs-dismiss="modal" onclick="limpiar_campos_new()">Cerrar</button>
                    <button type="button" id="btn_guardar_usuario" class="btn btn-primary btn-sm" @disabled(true)>Guardar</button>
                </div>
            </div>
        </div>
    </div>
    {{-- editar usuario --}}
    <div class="modal fade" id="editar_uusario" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Editar Usuario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="limpiar_campos_errores_us()"></button>
                </div>
                <div class="modal-body">
                    <form method="post" id="form_usuario_editado" class="formularios_des" autocomplete="off">
                        @csrf
                        <input type="hidden" id="id" name="id">
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">CI</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control input-rounded" name="ci_" id="ci_" placeholder="Ingrese numero de carnet">
                                <div id="_ci_" ></div>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Nombres</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control input-rounded" name="nombres_" id="nombres_" placeholder="Ingrese nombres">
                                <div id="_nombres_" ></div>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Apellido Paterno</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control input-rounded" name="apellido_paterno_" id="apellido_paterno_" placeholder="Ingrese el apellido paterno">
                                <div id="_apellido_paterno_" ></div>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Apellido Materno</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control input-rounded" name="apellido_materno_" id="apellido_materno_" placeholder="Ingrese el apellido materno">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger light btn-sm" data-bs-dismiss="modal" onclick="limpiar_campos_errores_us()">Cerrar</button>
                    <button type="button" id="btn_guardar_usuario_editado" class="btn btn-primary btn-sm">Guardar</button>
                </div>
            </div>
        </div>
    </div>
    {{-- reset usuario --}}
    <div class="modal fade" id="reset_usuario" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Reset Usuario y Contraseña</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="limpiar_campos_new()"></button>
                </div>
                <div class="modal-body">
                    <form method="post" id="form_usuario_reset" class="formularios_des" autocomplete="off">
                        @csrf
                        <input type="hidden" id="id__" name="id__">
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Usuario</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control input-rounded" name="usuario__" id="usuario__" placeholder="Ingrese usuario">
                                <div id="_usuario__" ></div>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Contraseña</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control input-rounded" name="password__" id="password__" placeholder="Ingrese contraseña">
                                <div id="_password__" ></div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger light btn-sm" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" id="btn_guardar_usuario_reset" class="btn btn-primary btn-sm">Guardar</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        //para validar el CI
        async function validar_ci(ci){
            if(ci.length > 5){
                try {
                    let respuesta = await fetch("{{ route('adm_validar_ci') }}",{
                        method: "POST",
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': token
                        },
                        body: JSON.stringify({ci:ci})
                    });
                    let dato = await respuesta.json();
                    let usuario_gen = document.getElementById('usuario');
                    let password_gen = document.getElementById('password');
                    if(dato.tipo === 'error'){
                        desabilitar_inputs_us(true);
                        usuario_gen.value   = '';
                        password_gen.value  = '';
                    }
                    if(dato.tipo === 'success'){
                        desabilitar_inputs_us(false);
                        usuario_gen.value = ci;
                        password_gen.value = 'GAM_'+ci;
                    }
                } catch (error) {
                    console.log('Ocurrio un error : '+error);
                }
            }else{
                desabilitar_inputs_us(true);
            }
        }
        //para guardar el usuario nuevo
        let guardar_usuario_btn = document.getElementById('btn_guardar_usuario');
        guardar_usuario_btn.addEventListener('click', async ()=>{
            let datos = Object.fromEntries(new FormData(document.getElementById('form_usuario')).entries());
            //try {
                let respuesta = await fetch("{{ route('adm_usuario_guardar') }}", {
                    method : 'POST',
                    headers:{
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(datos)
                });
                let dato = await respuesta.json();
                limpiar_errores_mensajes_us();
                mostrar_mensajes(dato.tipo, dato.mensaje);
            /* } catch (error) {
                console.log('Ocurrio un error : '+error);
            } */
        });
        //para limpiar los campos del input
        function limpiar_campos_new(){
            document.getElementById('form_usuario').reset();
            limpiar_errores_mensajes_us();
        }
        //para limpiar los errores
        function limpiar_errores_mensajes_us(){
            document.getElementById('_ci').innerHTML = '';
            document.getElementById('_nombres').innerHTML = '';
            document.getElementById('_apellido_paterno').innerHTML = '';
            document.getElementById('_usuario').innerHTML = '';
            document.getElementById('_password').innerHTML = '';
            desabilitar_inputs_us(true);
        }
        //para dasbilitar inputs
        function desabilitar_inputs_us(tipo){
            let nombre                  = document.getElementById('nombres');
            nombre.disabled             = tipo;
            nombre.value                = '';
            let apellido_paterno        = document.getElementById('apellido_paterno');
            apellido_paterno.disabled   = tipo;
            apellido_paterno.value      = '';
            let apellido_materno        = document.getElementById('apellido_materno');
            apellido_materno.disabled   = tipo;
            apellido_materno.value      = '';
            let usuario                 = document.getElementById('usuario');
            usuario.disabled            = tipo;
            usuario.value               = '';
            let password                = document.getElementById('password');
            password.disabled           = tipo;
            password.value              = '';
            let boton                   = document.getElementById('btn_guardar_usuario');
            boton.disabled              = tipo;
        }
        //eliminar uusario
        function eliminar_usuario(id){
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false,
                buttonsDistance: '12px'
            })

            swalWithBootstrapButtons.fire({
                title: 'NOTA!',
                text: "Esta seguro de eliminar?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Si, eliminar!',
                cancelButtonText: 'No, cancelar!',
                reverseButtons: true
            }).then( async (result) => {
                if (result.isConfirmed) {
                    try {
                        let respuesta = await fetch("{{ route('adm_eliminar_us') }}",{
                            method:"DELETE",
                            headers: {
                                'content-type': 'application/json',
                                'X-CSRF-TOKEN': token
                            },
                            body: JSON.stringify({id:id}),
                        });
                        let dato = await respuesta.json();
                        mostrar_mensajes(dato.tipo, dato.mensaje);
                    } catch (error) {
                        console.log("Error en : "+error);
                    }
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    alerta_top('error','Se cancelo');
                }
            })
        }
        //para editar el usuario
        let modal_editar_usuario = new bootstrap.Modal(document.getElementById('editar_uusario'), {
            keyboard: false
        });
        async function editar_usuario(id){
            try {
                modal_editar_usuario.show();
                limpiar_campos_errores_us();
                let respuesta = await fetch("{{ route('adm_editar_us') }}", {
                    method:'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token
                    },
                    body: JSON.stringify({id:id})
                });
                let dato = await respuesta.json();
                if(dato.tipo==='good'){
                    document.getElementById('id').value = dato.mensaje.id;
                    document.getElementById('ci_').value = dato.mensaje.ci;
                    document.getElementById('nombres_').value = dato.mensaje.nombres;
                    document.getElementById('apellido_paterno_').value = dato.mensaje.apellido_paterno;
                    document.getElementById('apellido_materno_').value = dato.mensaje.apellido_materno;
                }else{
                    mostrar_mensajes(dato.tipo, dato.mensaje);
                }
            } catch (error) {
                console.log('Error :'+error);
            }
        }
        //vaicar los campos que son errores
        function limpiar_campos_errores_us(){
            document.getElementById('_ci_').innerHTML='';
            document.getElementById('_nombres_').innerHTML='';
            document.getElementById('_apellido_paterno_').innerHTML='';
        }
        //para editar la parte de los usuarios
        let btn_guardar_usuario_editado = document.getElementById('btn_guardar_usuario_editado');
        btn_guardar_usuario_editado.addEventListener('click', async () => {
            let datos = Object.fromEntries(new FormData(document.getElementById('form_usuario_editado')).entries());
            try {
                let respuesta = await fetch("{{ route('adm_editar_guardar_us') }}", {
                    method:'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(datos)
                });
                let dato = await respuesta.json();
                limpiar_campos_errores_us();
                mostrar_mensajes(dato.tipo, dato.mensaje);
            } catch (error) {
                console.log('Error :'+error);
            }
        });

        //reset de usuario y password
        let modal_reset_usuario = new bootstrap.Modal(document.getElementById('reset_usuario'), {
            keyboard: false
        });
        async function reset_usuario(id){
            vaciar_errores_reset_usuario();
            try {
                modal_reset_usuario.show();
                let respuesta = await fetch("{{ route('adm_reset_us') }}",{
                    method:"POST",
                    headers: {
                        'content-type': 'application/json',
                        'X-CSRF-TOKEN': token
                    },
                    body: JSON.stringify({id:id}),
                });
                let dato = await respuesta.json();
                if(dato.tipo==='good'){
                    document.getElementById('id__').value = dato.mensaje.id;
                    document.getElementById('usuario__').value = dato.mensaje.ci;
                    document.getElementById('password__').value = dato.mensaje.ci;
                }else{
                    mostrar_mensajes(dato.tipo, dato.mensaje);
                }
            } catch (error) {
                console.log("Error en : "+error);
            }
        }
        //guardar los datos reset
        let btn_guardar_usuario_reset = document.getElementById('btn_guardar_usuario_reset');
        btn_guardar_usuario_reset.addEventListener('click', async ()=>{
            let datos = Object.fromEntries(new FormData(document.getElementById('form_usuario_reset')).entries());
            try {
                let respuesta = await fetch("{{ route('adm_guardar_reset_us') }}", {
                    method:'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(datos)
                });
                let dato = await respuesta.json();
                console.log(dato);
                vaciar_errores_reset_usuario();
                mostrar_mensajes(dato.tipo, dato.mensaje);
            } catch (error) {
                console.log('Error :'+error);
            }
        });
        //para vaciar los errores
        function vaciar_errores_reset_usuario(){
            document.getElementById('_usuario__').innerHTML     = '';
            document.getElementById('_password__').innerHTML    = '';
        }
    </script>
@endsection
