    <script src="{{ asset('plantilla_admin/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('plantilla_admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>



    {{-- <script src="{{ asset('plantilla_admin/vendor/chartjs/chartjs.js') }}"></script>
    <script src="{{ asset('plantilla_admin/js/plugins/chartjs-line-init.js') }}"></script>
    <script src="{{ asset('plantilla_admin/js/plugins/chartjs-donut.js') }}"></script>
    <script src="{{ asset('plantilla_admin/vendor/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('plantilla_admin/js/plugins/perfect-scrollbar-init.js') }}"></script>
    <script src="{{ asset('plantilla_admin/vendor/circle-progress/circle-progress.min.js') }}"></script>
    <script src="{{ asset('plantilla_admin/js/plugins/circle-progress-init.js') }}"></script> --}}
    <script src="{{ asset('plantilla_admin/js/scripts.js') }}"></script>

    <script src="{{ asset('plantilla_admin/archivos/swetalert2.js') }}"></script>

    <script src="{{ asset('plantilla_admin/archivos/datatables.js') }}"></script>


    <script>

        let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        let btn_cerrar_session = document.getElementById("btn-cerrar-session");
        btn_cerrar_session.addEventListener("click", async ()=>{
            let datos = Object.fromEntries(new FormData(document.getElementById('formulario_salir')).entries());
            try {
                let respuesta = await fetch("{{ route('salir') }}",{
                    method:"POST",
                    headers:{
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(datos)
                });
                let dato = await respuesta.json();
                alerta_top(dato.tipo, dato.mensaje);
                setTimeout(() => {
                    window.location = '';
                }, 1500);

            } catch (error) {
                console.log('Ocurrio un error'+error);
            }
        });


        function alerta_top(tipo, mensaje){
            Swal.fire({
                position: 'top-end',
                icon: tipo,
                title: mensaje,
                showConfirmButton: false,
                timer: 1500
            })
        }
        //para los mensjaes de error para mostrar
        function mostrar_mensajes(tipo, mensaje){
            if(tipo==='errores'){
                let obj = mensaje;
                for (let key in obj) {
                    document.getElementById('_'+key).innerHTML = `<p id="error_color" >`+obj[key]+`</p>`;
                }
            }
            if(tipo==='error'){
                alerta_top(tipo, mensaje);
            }
            if(tipo==='success'){
                alerta_top(tipo, mensaje);
                setTimeout(() => {
                    window.location = '';
                }, 1500);
            }
        }
    </script>
