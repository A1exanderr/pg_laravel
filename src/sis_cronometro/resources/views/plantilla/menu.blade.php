<div class="sidebar">
    <div class="brand-logo">
        <a class="full-logo" href="index-2.html"><img src="{{ asset('plantilla_admin/images/logoi.png') }}" alt="" width="30"></a>
    </div>
    <div class="menu">
        <ul>
            <li><a href="{{ route('pc_index') }}">
                    <span><i class="ri-home-5-line"></i></span>
                    <span class="nav-text">Registro</span>
                </a>
            </li>
            <li><a href="{{ route('tc_index') }}">
                    <span><i class="ri-wallet-line"></i></span>
                    <span class="nav-text">Tipo</span>
                </a>
            </li>

            <li>
                <a href="{{ route('cc_index') }}">
                    <span><i class="ri-secure-payment-line"></i></span>
                    <span class="nav-text">Carrera</span>
                </a>
            </li>

            {{--
            <li><a href="invoice.html">
                    <span><i class="ri-file-copy-2-line"></i></span>
                    <span class="nav-text">Invoice</span>
                </a>
            </li>
            <li><a href="settings-profile.html">
                    <span><i class="ri-settings-3-line"></i></span>
                    <span class="nav-text">Settings</span>
                </a>
            </li>
            <li class="logout"><a href="signin.html">
                    <span><i class="ri-logout-circle-line"></i></span>
                    <span class="nav-text">Signout</span>
                </a>
            </li> --}}
        </ul>
    </div>
</div>
