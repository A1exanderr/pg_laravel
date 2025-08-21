    <div class="header">
        <div class="container">
            <div class="row">
                <div class="col-xxl-12">
                    <div class="header-content">
                        <div class="header-left">
                            <h4>PANEL DE ADMINISTRACIÓN</h4>
                        </div>
                        <div class="header-right">
                            <div class="dark-light-toggle"><span class="dark"><i class="ri-moon-line"></i></span><span class="light"><i class="ri-sun-line"></i></span></div>
                                <div class="dropdown profile_log dropdown">
                                    <div data-toggle="dropdown" aria-haspopup="true" class="" aria-expanded="false">
                                        <div class="user icon-menu active"><span><i class="ri-user-line"></i></span></div>
                                    </div>
                                    <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu dropdown-menu dropdown-menu-right">
                                        <div class="user-email">
                                            <div class="user">
                                            <span class="thumb">
                                                <img src="{{ asset('logos/gamch.jpg') }}" alt="">
                                            </span>
                                            <div class="user-info">
                                                <h5>GAMCH</h5>
                                                <span>Gobierno Autónomo Municipal de Chulumani</span>
                                                <!-- <h5>{{ Auth::user()->nombres }}</h5>
                                                <span>{{ Auth::user()->apellido_paterno.' '.Auth::user()->apellido_materno }}</span> -->
                                            </div>
                                        </div>
                                    </div>
                                    <a class="dropdown-item" href="{{ route('perfil') }}">
                                        <span><i class="ri-user-line"></i></span>
                                        Perfil
                                    </a>
                                    <a class="dropdown-item logout" href="#" id="btn-cerrar-session">
                                        <i class="ri-logout-circle-line"></i>
                                        Salir
                                    </a>
                                    <form id="formulario_salir">@csrf</form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
