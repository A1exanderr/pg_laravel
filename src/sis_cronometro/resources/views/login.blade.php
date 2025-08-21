<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Intez</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('plantilla_admin/images/favicon.png') }}">
    <!-- Custom Stylesheet -->
    <link rel="stylesheet" href="{{ asset('plantilla_admin/css/style.css') }}">
</head>

<body class="@@class">

<div id="preloader">
    <i>.</i>
    <i>.</i>
    <i>.</i>
</div>

<div class="authincation section-padding">
    <div class="container h-100">
        <div class="row justify-content-center h-100 align-items-center">
            <div class="col-xl-5 col-md-6">
                <div class="mini-logo text-center my-4">
                    <h1 >LOGIN</h1>
                </div>
                <div class="auth-form card">
                    <div class="card-body">
                        <div id="error_datos" class="text-center"></div>
                        <form method="post" id="formulario-login" class="row g-3" autocomplete="off">
                            @csrf
                            <div class="col-12">
                                <label class="form-label">USUARIO</label>
                                <input type="text" class="form-control" placeholder="Ingrese usuario" name="usuario" id="usuario">
                            </div>
                            <div class="col-12">
                                <label class="form-label">CONTRASEÑA</label>
                                <input type="password" class="form-control" placeholder="Contraseña" name="password" id="password">
                            </div>
                            <div class="d-grid gap-2">
                                <button type="button" id="btn-ingresar" class="btn btn-primary">Ingresar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('plantilla_admin/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('plantilla_admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('plantilla_admin/js/scripts.js') }}"></script>
<script>
    let btn_ingresar = document.getElementById('btn-ingresar');
    let input_usuario = document.getElementById('usuario');
    let input_password = document.getElementById('password');
    btn_ingresar.addEventListener('click',  async ()=>{
        let datos = Object.fromEntries(new FormData(document.getElementById('formulario-login')).entries());
        try {
            let respuesta = await fetch("{{ route('ingresar') }}",{
                method: 'POST',
                headers:{
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(datos)
            });
            let data = await respuesta.json();
            if(data.tipo==='success'){
                document.getElementById('error_datos').innerHTML = `<p style="color:blue" >`+data.mensaje+`</p>`;
                window.location = '';
            }
            if(data.tipo==='error'){
                document.getElementById('error_datos').innerHTML = `<p style="color:red" >`+data.mensaje+`</p>`;
            }
        } catch (error) {
            console.log('existe un error'+error);
        }
    });

</script>
</body>
</html>


