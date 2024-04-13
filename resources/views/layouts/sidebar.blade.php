<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="{{ asset('dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">{{ config('app.name') }}<span
                class="font-weight-bold">Panel</span></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('storage/' . auth()->user()->photo) }}" class="img-circle elevation-2"
                    alt="{{ auth()->user()->name }}">
            </div>
            <div class="info text-white">
                {{-- <a href="#" class="d-block"></a> --}}
                {{ auth()->user()->name }}<br />
                <small>{{ strtoupper(auth()->user()->role) }}</small>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent nav-flat" data-widget="treeview"
                role="menu" data-accordion="false">
                {{-- <li class="nav-item menu-open">
                    <a href="#" class="nav-link active">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Starter Pages
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link active">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Active Page</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Inactive Page</p>
                            </a>
                        </li>
                    </ul>
                </li> --}}
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item menu-close">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa-solid fa-file-circle-question"></i>
                        <p>
                            Item Request
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('item-request') }}" class="nav-link">
                                <i class="nav-icon fa-solid fa-table"></i>
                                <p>List Item Request</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('item-request.create') }}" class="nav-link">
                                <i class="nav-icon fa-solid fa-plus"></i>
                                <p>Tambah Item Request</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item menu-close">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa-solid fa-file-circle-question"></i>
                        <p>
                            Request Approval
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('item-approval-pending') }}" class="nav-link">
                                <i class="nav-icon fa-solid fa-table"></i>
                                <p>List Request </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('item-approval-approved') }}" class="nav-link">
                                <i class="nav-icon fa-solid fa-table"></i>
                                <p>List Approved</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item menu-close">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa-solid fa-timeline"></i>
                        <p>
                            Work Order
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('work-order.instalasi-baru') }}" class="nav-link">
                                <i class="nav-icon fa-solid fa-table"></i>
                                <p>Instalasi Baru</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('item-approval-approved') }}" class="nav-link">
                                <i class="nav-icon fa-solid fa-table"></i>
                                <p>Maintenance</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('item-approval-approved') }}" class="nav-link">
                                <i class="nav-icon fa-solid fa-table"></i>
                                <p>Dismantle</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item menu-close">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-warehouse"></i>
                        <p>
                            Warehouse
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('stock-monitor') }}" class="nav-link">
                                <i class="fas fa-cubes-stacked nav-icon"></i>
                                <p>Stock Monitor</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('stock-in') }}" class="nav-link">
                                <i class="fas fa-people-carry-box nav-icon"></i>
                                <p>Stock IN</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('stock-out') }}" class="nav-link">
                                <i class="fas fa-truck-moving nav-icon"></i>
                                <p>Stock OUT</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item menu-close">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-cogs"></i>
                        <p>
                            Configuration
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('user') }}" class="nav-link">
                                <i class="fas fa-users nav-icon"></i>
                                <p>Users</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('team') }}" class="nav-link">
                                <i class="fas fa-tags nav-icon"></i>
                                <p>Teams</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('category-item') }}" class="nav-link">
                                <i class="fas fa-clipboard-list nav-icon"></i>
                                <p>Category Items</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('tipe-item') }}" class="nav-link">
                                <i class="fas fa-tag nav-icon"></i>
                                <p>Tipe Items</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('item') }}" class="nav-link">
                                <i class="fas fa-clipboard-check nav-icon"></i>
                                <p>Items</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('vendor') }}" class="nav-link">
                                <i class="fas fa-industry nav-icon"></i>
                                <p>Vendor</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ route('logout') }}" class="nav-link"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>
                            Logout
                        </p>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
