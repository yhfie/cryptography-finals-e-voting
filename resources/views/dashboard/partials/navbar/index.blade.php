<nav class="navbar navbar-expand navbar-dark bg-primary topbar mb-4 static-top shadow">
    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>
    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">

        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-4 d-none d-lg-inline text-white">{{ $user }}</span>
                @if ($image)
                    <img class="img-profile rounded-circle" src="{{ asset('storage/' . $image) }}">
                @else
                    <img class="img-profile rounded-circle" src="{{ asset('img/default.jpg') }}">
                @endif
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                aria-labelledby="userDropdown">
                <a class="dropdown-item btn-danger" href="#" data-toggle="modal" data-target="#logoutModal">
                    Keluar
                </a>
            </div>
        </li>
    </ul>
</nav>
