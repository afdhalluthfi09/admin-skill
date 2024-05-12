<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="{{ asset('dist/img/logo_pbs.png') }}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">SekolahSkill</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">Lupa</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item menu-open">
                    <a href="./index.html" class="nav-link active">
                        <i class="nav-icon fas fa-th"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('kelas') }}" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Kelas
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="pages/widgets.html" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Peserta
                            <span class="right badge badge-danger">New</span>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('artikel') }}" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Blog
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('users.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            User
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('trasaction.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Transaksi
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('loker.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Loker
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            Pengaturan
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('sop.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>SOP</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('loker.setting') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Kategori Loker</p>
                            </a>
                        </li>
                    </ul>
                </li>
                    
                <li class="nav-item">
                 <a href="#" class="nav-link">
                     <i class="nav-icon fas fa-copy"></i>
                     <p>
                         Pengaturan Event
                         <i class="fas fa-angle-left right"></i>
                     </p>
                 </a>
                 <ul class="nav nav-treeview">
                     <li class="nav-item">
                         <a href="{{ route('sop.index') }}" class="nav-link">
                             <i class="far fa-circle nav-icon"></i>
                             <p>Peserta</p>
                         </a>
                     </li>
                     <li class="nav-item">
                         <a href="{{ route('event.list') }}" class="nav-link">
                             <i class="far fa-circle nav-icon"></i>
                             <p>List Event</p>
                         </a>
                     </li>
                     <li class="nav-item">
                         <a href="{{ route('event.setting') }}" class="nav-link">
                             <i class="far fa-circle nav-icon"></i>
                             <p>setting</p>
                         </a>
                     </li>
                 </ul>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
