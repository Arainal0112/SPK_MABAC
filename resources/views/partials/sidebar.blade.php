<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-secondary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="">
        <div class="sidebar-brand-icon">
            <img src="{{ asset('img/logo.png') }}" width="60%">
        </div>
        <div class="sidebar-brand-text mx-3">MABAC SISTEM</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ Nav::isRoute('home') }}">
        <a class="nav-link rounded-left" href="{{ route('home') }}">
            <div class="row">
                <div class="col-2">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                </div>
                <div class="col">
                    <span>{{ __('Dashboard') }}</span>
                </div>
            </div>
        </a>
    </li>
    <li class="nav-item {{ Nav::isRoute('kriteria.index') }}">
        <a class="nav-link rounded-left" href="{{ route('kriteria.index') }}">
            <div class="row">
                <div class="col-2">
                    <i class="fa-brands fa-get-pocket"></i>
                </div>
                <div class="col">
                    <span>{{ __('Kriteria') }}</span>
                </div>
            </div>
        </a>
    </li>
    <li class="nav-item {{ Nav::isRoute('alternatif.index') }}">
        <a class="nav-link rounded-left" href="{{ route('alternatif.index') }}">
            <div class="row">
                <div class="col-2">
                    <i class="fa-solid fa-users"></i>
                </div>
                <div class="col">
                    <span>{{ __('Alternatif') }}</span>
                </div>
            </div>
        </a>
    </li>
    <li class="nav-item {{ Nav::isRoute('sub.index') }}">
        <a class="nav-link rounded-left" href="{{ route('sub.index') }}">
            <div class="row">
                <div class="col-2">
                    <i class="fa-brands fa-get-pocket"></i>
                </div>
                <div class="col">
                    <span>{{ __('Sub Kriteria') }}</span>
                </div>
            </div>
        </a>
    </li>
    <li class="nav-item {{ Nav::isRoute('matriks.index') }}">
        <a class="nav-link rounded-left" href="{{ route('matriks.index') }}">
            <div class="row">
                <div class="col-2">
                    <i class="fa-solid fa-square-poll-horizontal"></i>
                </div>
                <div class="col">
                    <span>{{ __('Matriks') }}</span>
                </div>
            </div>
        </a>
    </li>
    <li class="nav-item {{ Nav::isRoute('hasil.index') }}">
        <a class="nav-link rounded-left" href="{{ route('hasil.index') }}">
            <div class="row">
                <div class="col-2">
                    <i class="fa-solid fa-square-poll-horizontal"></i>
                </div>
                <div class="col">
                    <span>{{ __('Hasil') }}</span>
                </div>
            </div>
        </a>
    </li>


    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        {{ __('Settings') }}
    </div>

    <!-- Nav Item - Profile -->
    <li class="nav-item {{ Nav::isRoute('profile') }}">
        <a class="nav-link" href="{{ route('profile') }}">
            <div class="row">
                <div class="col-2">
                    <i class="fas fa-fw fa-user"></i>
                </div>
                <div class="col">
                    <span>{{ __('Profile') }}</span>
                </div>
            </div>
        </a>
    </li>

    <!-- Nav Item - About -->
    <li class="nav-item {{ Nav::isRoute('about') }}">
        <a class="nav-link" href="{{ route('about') }}">
            <div class="row">
                <div class="col-2">
                    <i class="fas fa-fw fa-hands-helping"></i>
                </div>
                <div class="col">
                    <span>{{ __('About') }}</span>
                </div>
            </div>
        </a>
    </li>
    <li class="nav-item {{ Nav::isRoute('logout') }}">
        <a class="nav-link" href="#" data-toggle="modal" data-target="#logoutModal">
            <div class="row">
                <div class="col-2">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw"></i>
                </div>
                <div class="col">
                    <span>{{ __('Logout') }}</span>
                </div>
            </div>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->
<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('Apakah Anda Yakin Untuk Logout?') }}</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Pilih "Logout" di bawah jika Anda ingin untuk mengakhiri sesi Anda saat ini.</div>
            <div class="modal-footer">
                <button class="btn btn-link" type="button" data-dismiss="modal">{{ __('Cancel') }}</button>
                <a class="btn btn-danger" href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </div>
    </div>
</div>
