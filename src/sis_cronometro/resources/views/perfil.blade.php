@extends('principal')
@section('titulo')
    PERFIL
@endsection
@section('contenido')

<div class="content-body">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="page-title">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-xl-4">
                            <div class="page-title-content">
                                <h3>Perfil</h3>
                            </div>
                        </div>
                        <div class="col-auto">
                            <div class="breadcrumbs">
                                <a href="#">Perfil</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xxl-6 col-xl-6 col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Datos Personales</h4>
                        </div>
                        <div class="card-body">
                            <form id="form_datos_personales" method="post" autocomplete="off">
                                @csrf
                                <input type="hidden" name="id" id="id" value="{{ Auth::user()->id }}">
                                <div class="card-body ItemsCheckboxSec">
                                    <div class="row align-items-center">
                                        <div class="col-xl-4">
                                            <h6>Nombres</h6>
                                        </div>
                                        <div class="col-xl-8">
                                            <input type="text" class="form-control mb-2" placeholder="Ingrese su nombres" name="nombres" id="nombres" value="{{ Auth::user()->nombres }}" >
                                        </div>
                                        <div id="_nombres" ></div>
                                    </div>
                                    <div class="row align-items-center">
                                        <div class="col-xl-4">
                                            <h6>Apellido Paterno</h6>
                                        </div>
                                        <div class="col-xl-8">
                                            <input type="text" class="form-control mb-2" placeholder="Ingrese su Apellido Paterno" name="apellido_paterno" id="apellido_paterno" value="{{ Auth::user()->apellido_paterno }}">
                                        </div>
                                        <div id="_apellido_paterno"></div>
                                    </div>
                                    <div class="row align-items-center">
                                        <div class="col-xl-4">
                                            <h6>Apellido Materno</h6>
                                        </div>
                                        <div class="col-xl-8">
                                            <input type="text" class="form-control mb-2" placeholder="Ingrese su Apellido Materno" name="apellido_materno" id="apellido_materno" value="{{ Auth::user()->apellido_materno }}">
                                        </div>
                                        <div id="_apellido_materno" ></div>
                                    </div>
                                    <div class="row align-items-center">
                                        <div class="col-xl-4">
                                            <h6>Celular</h6>
                                        </div>
                                        <div class="col-xl-8 py-2">
                                            <input type="text" class="form-control mb-2" placeholder="Ingrese su celular" name="celular" id="celular" value="{{ Auth::user()->celular }}">
                                            <div id="_celular"></div>
                                        </div>

                                    </div>
                                    <div class="row align-items-center">
                                        <div class="col-xl-4">
                                            <h6>Email</h6>
                                        </div>
                                        <div class="col-xl-8 py-2">
                                            <input type="text" class="form-control mb-2" placeholder="Ingrese su Email" name="email" id="email" value="{{ Auth::user()->email }}">
                                        </div>
                                        <div id="_email" ></div>
                                    </div>
                                </div>
                                <div class="content-title py-2">
                                    <button type="button" id="btn_guardar_dpp" class="btn btn-secondary">Guardar datos</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-6 col-xl-6 col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Seguridad de Contrasña</h4>
                        </div>
                        <div class="card-body">
                            <form id="form_password" method="post">
                                @csrf
                                <input type="hidden" id="id_p" name="id_p" value="{{ Auth::user()->id }}">
                                <div class="row align-items-center">
                                    <div class="col-xl-4">
                                        <h6>Ingrese contraseña</h6>
                                    </div>
                                    <div class="col-xl-8">
                                        <input type="password" class="form-control mb-2" name="password" id="password" placeholder="Ingrese una contraseña">
                                        <div id="_password" ></div>
                                    </div>
                                    <div class="col-xl-4">
                                        <h6 class="mb-xl-0 text-nowrap ">Repita la contraseña</h6>
                                    </div>
                                    <div class="col-xl-8">
                                        <input type="password" class="form-control" id="repetir_password" name="repetir_password" placeholder="Repita la contraseña ingresada">
                                        <div id="_repetir_password" ></div>
                                    </div>
                                </div>
                            </form>
                            <div class="content-title py-2">
                                <button type="button" id="btn_guardar_password" class="btn btn-secondary">Guardar contraseña</button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('scripts')
    <script>
        let btn_guardar_dpp = document.getElementById('btn_guardar_dpp');
        btn_guardar_dpp.addEventListener('click', async ()=>{
            let datos = Object.fromEntries(new FormData(document.getElementById('form_datos_personales')).entries());
            try {
                let respuesta = await fetch("{{ route('adm_guardar_perfil') }}",{
                    method:"POST",
                    headers:{
                        'Content-Type': "application/json"
                    },
                    body: JSON.stringify(datos)
                });
                let dato = await respuesta.json();
                vaciar_errores_p();
                mostrar_mensajes(dato.tipo, dato.mensaje);
            } catch (error) {
                console.log('Ocurrio un error: ' + error);
            }
        });

        function vaciar_errores_p(){
            document.getElementById('_nombres').innerHTML           = '';
            document.getElementById('_apellido_paterno').innerHTML  = '';
            document.getElementById('_apellido_materno').innerHTML  = '';
            document.getElementById('_celular').innerHTML           = '';
            document.getElementById('_email').innerHTML             = '';
        }

        //para guardar la contraseña
        let btn_guardar_pss = document.getElementById('btn_guardar_password');
        btn_guardar_pss.addEventListener('click', async ()=>{
            let datos = Object.fromEntries(new FormData(document.getElementById('form_password')).entries())
            try {
                let respuesta = await fetch("{{ route('adm_password_g') }}", {
                    method:'POST',
                    headers:{
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(datos),
                });
                let dato = await respuesta.json();
                vaciar_errores_pass();
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
                    setTimeout(() => {
                        window.location = '';
                    }, 1500);
                }
            } catch (error) {
                console.log('Error en los datos: '+error);
            }
        });

        function vaciar_errores_pass(){
            document.getElementById('_password').innerHTML           = '';
            document.getElementById('_repetir_password').innerHTML   = '';
        }
    </script>
@endsection

