<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('admin.index') }}" class="brand-link">
        <!--  <img src="{{ asset('images/profile.png') }}" alt="Sentinelone Logo" class="brand-image elevation-3" style="opacity: .8"> -->
        <span class="brand-text font-weight-light">Online AU-PAIRS Admin</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('images/profile.png') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block"> {{ Auth::user()->name }}</a>
            </div>
        </div>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" role="menu" data-accordion="false">
                <li class="nav-item menu-open">
                    <a href="{{ route('admin.index') }}" class="nav-link {{ request()->is('admin') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                {{-- <li class="nav-item menu-open">
                    <a href="{{ route('admin.packages') }}" class="nav-link {{ request()->is('admin/packages') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-gift"></i>
                        <p>
                            Packages
                        </p>
                    </a>
                </li> --}}
                <li class="nav-item menu-open">
                    <a href="{{ route('admin.candidates') }}" class="nav-link {{ request()->is('admin/candidates') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Candidates
                        </p>
                    </a>
                </li>
                <li class="nav-item menu-open">
                    <a href="{{ route('admin.families') }}" class="nav-link {{ request()->is('admin/families') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Families
                        </p>
                    </a>
                </li>

                <li class="nav-item menu-open">
                    <a href="{{ route('admin.contact') }}" class="nav-link {{ request()->is('admin/contact') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-address-book"></i>
                        <p>
                            Contact
                        </p>
                    </a>
                </li>

                <li class="nav-item menu-open">
                    <a href="{{ route('admin.transactions') }}" class="nav-link {{ request()->is('admin/transactions') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-money-bill"></i>
                        <p>
                            Transactions
                        </p>
                    </a>
                </li>

                <li class="nav-item menu-open">
                    <a href="{{ route('admin.reviews') }}" class="nav-link {{ request()->is('admin/reviews') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-comment"></i>
                        <p>
                            Reviews
                        </p>
                    </a>
                </li>

                <li class="nav-item menu-open">
                    <a href="{{ route('admin.change-password') }}" class="nav-link {{ request()->is('admin/change-password') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-lock"></i>
                        <p>
                            Change Password
                        </p>
                    </a>
                </li>
                <li class="nav-item menu-open">
                    <form action="{{ route('logout') }}" id="logoutForm" method="post">
                        @csrf
                    </form>
                    <a href="javascript:void(0)" onclick="localStorage.removeItem('firstLoad');document.getElementById('logoutForm').submit();" class="nav-link ">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Logout
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>