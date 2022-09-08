<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="{{route('home')}}">
                <i class="icon-grid menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        @can('user.*')
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
                    <i class="icon-head menu-icon"></i>
                    <span class="menu-title">User</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="auth">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"><a class="nav-link" href="{{route('user.index')}}"> Listing </a></li>
                    </ul>
                </div>
            </li>
        @endcan
        @can('vehicle.*')
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#vehicle" aria-expanded="false" aria-controls="vehicle">
                    <i class="mdi mdi-car menu-icon"></i>
                    <span class="menu-title">Vehicle</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="vehicle">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"><a class="nav-link" href="{{route('vehicle.index')}}"> Listing </a></li>
                    </ul>
                </div>
            </li>
        @endcan
        @can('transfer.*')
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#transfer" aria-expanded="false" aria-controls="transfer">
                    <i class="mdi mdi-shuffle-variant menu-icon"></i>
                    <span class="menu-title">Transfer</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="transfer">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"><a class="nav-link" href="{{route('transfer.index')}}"> Listing </a></li>
                    </ul>
                </div>
            </li>
        @endcan
    </ul>
</nav>
