<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('home')}}" class="brand-link">
        <img src="{{asset('dist/img/logo.png')}}" alt=" Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">QUIZ PORTAL</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{asset('dist/img/default.png')}}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{Auth::user()->name}}</a>
            </div>
        </div>



        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->

                <li class="nav-item">
                    <a href="{{route('home')}}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>



                <li class="nav-item">
                    <a href="{{route('questions.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-question-circle"></i>
                        <p>
                            Questions
                            <span class="right badge badge-danger">New</span>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('applicants.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Applicants

                        </p>
                    </a>
                </li>
                <li class="nav-item ">
                    <a href="{{route('settings')}}" class="nav-link">
                        <i class="nav-icon fas fa-tools"></i>
                        <p>
                            Settings
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('departments.index')}}" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Departments</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('ranks.index')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Ranks</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('jobs.index')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>job Families</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('regions.index')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Regions</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('zones.index')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Zones</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('ranks.index')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Ranks</p>
                            </a>
                        </li>

                    </ul>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        <i class="nav-icon fas fa-power-off"></i>
                        <p>
                            Log Out

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
