<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'ONLINE-AUPAIRS') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/select2/select2.min.css')}}">
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/iCheck/flat/blue.css')}}">
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/iCheck/all.css')}}">
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/jqvmap/jqvmap.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/summernote/summernote-bs4.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/dist/css/custom.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <style>
        a{text-decoration: none!important;}
        .form-control-sm { padding: 0.25rem 0.9rem;}
        body {
            overflow-x: hidden;
        }
    </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{ url('/') }}" class="nav-link">Home</a>
                </li>
            </ul>
        </nav>
        <aside class="main-sidebar sidebar-dark-primary elevation-4" id="left-menubar" style="min-height:0!important; overflow-x: hidden;">
            <a href="{{url('/')}}" class="brand-link" style="text-align: center">
                <span class="brand-text font-weight-light"><b>ONLINE-AU ADMIN</b></span>
            </a>

            <div class="sidebar">
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-item has-treeview @if(isset($menu) && $menu=='User') menu-open  @endif" style="border-bottom: 1px solid #4f5962; margin-bottom: 4.5%;">
                            <a href="#" class="nav-link @if(isset($menu) && $menu=='User') active  @endif">
                                <img src=" {{url('assets/dist/img/AdminLTELogo.png')}}" class="img-circle elevation-2" alt="User Image" style="width: 2.1rem; margin-right: 1.5%;">
                                <p style="padding-right: 6.5%;">
                                    &nbsp;{{ strtoupper(Auth::user()->name) }}
                                    <i class="fa fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <?php $eid = \Illuminate\Support\Facades\Auth::user()->id; ?>
                                    <a href="{{ url('admin/profile/'.$eid.'/edit') }}" class="nav-link @if(isset($menu) && $menu=='User') active @endif">
                                        <i class="nav-icon fa fa-edit"></i><p class="text-warning">Edit Profile</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="nav-icon fa fa-sign-out-alt"></i><p class="text-danger">Log out</p>
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a href="{{ url('admin') }}" class="nav-link @if($menu=='Dashboard') active @endif">
                                <i class="nav-icon fa fa-tachometer-alt"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>

                        
                        <li class="nav-item @if(in_array($menu, ['family','family petsitting'])) menu-is-opening menu-open @endif">
                            <a href="#" class="nav-link @if(in_array($menu, ['family','family petsitting'])) active @endif">
                                <i class="nav-icon fa fa-users"></i>
                                <p>Families<i class="fas fa-angle-left right"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.families') }}" class="nav-link @if($menu=='family') active @endif">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Manage Families</p>
                                    </a>
                                </li>
                            </ul>

                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ url('admin/family-petsitting') }}" class="nav-link @if($menu=='family petsitting') active @endif">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Manage Petisitting</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item @if(in_array($menu, ['aupairs','nannies', 'babysitters', 'petsitters'])) menu-is-opening menu-open @endif">
                            <a href="#" class="nav-link @if(in_array($menu, ['Stock Category','Stock'])) active @endif">
                                <i class="nav-icon fas fa-user"></i>
                                <p>Candidates<i class="fas fa-angle-left right"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('admin.candidates.aupairs')}}" class="nav-link @if($menu=='aupairs') active @endif">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Manage Au-Pairs</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('admin.candidates.babysitters')}}" class="nav-link @if($menu=='babysitters') active @endif">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Manage Babysitters</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('admin.candidates.petsitters')}}" class="nav-link @if($menu=='petsitters') active @endif">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Manage Petsitters</p>
                                    </a>
                                </li>

                                 <li class="nav-item">
                                    <a href="{{route('admin.candidates.nannies')}}" class="nav-link @if($menu=='nannies') active @endif">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Manage Nannies</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a href="{{ url('admin/reviews') }}" class="nav-link @if($menu=='reviews') active @endif">
                                <i class="nav-icon fa fa-comments"></i>
                                <p>Reviews</p>
                            </a>
                        </li>

                        <li class="nav-item @if(in_array($menu, ['cancel requests'])) menu-is-opening menu-open @endif">
                            <a href="#" class="nav-link @if(in_array($menu, ['cancel requests'])) active @endif">
                                <i class="nav-icon fa fa-file-invoice-dollar"></i>
                                <p>Subscriptions<i class="fas fa-angle-left right"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.subscriptions.cancel-requests') }}" class="nav-link @if($menu=='cancel requests') active @endif">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Manage Cancel Requests</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a href="{{ url('admin/transactions') }}" class="nav-link @if($menu=='transactions') active @endif">
                                <i class="nav-icon fa fa-money-bill"></i>
                                <p>Transactions</p>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>

        @yield('content')

        <footer class="main-footer">
            <strong>ONLINE-AU ADMIN @ 2024</strong>
        </footer>
    </div>

    <script>
        var base_path = '{{ url('/') }}/';
    </script>

    <script src="{{ URL('assets/plugins/jquery/jquery.min.js')}}"></script>
    <script src="{{ URL('assets/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
    <script>
    $.widget.bridge('uibutton', $.ui.button)
    </script>
    <script src="{{ URL('assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{ URL('assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{ URL('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{ URL('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{ URL('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
    <script src="{{ URL('assets/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{ URL('assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{ URL::asset('assets/plugins/select2/select2.full.min.js')}}"></script>
    <script src="{{ URL('assets/plugins/chart.js/Chart.min.js')}}"></script>
    <script src="{{ URL('assets/plugins/sparklines/sparkline.js')}}"></script>
    <script src="{{ URL('assets/plugins/jquery-knob/jquery.knob.min.js')}}"></script>
    <script src="{{ URL('assets/plugins/moment/moment.min.js')}}"></script>
    <script src="{{ URL('assets/plugins/daterangepicker/daterangepicker.js')}}"></script>
    <script src="{{ URL('assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
    <script src="{{ URL('assets/plugins/summernote/summernote-bs4.min.js')}}"></script>
    <script src="{{ URL('assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
    <script src="{{ URL('assets/dist/js/adminlte.js')}}"></script>
    <script src="{{ URL('assets/dist/js/demo.js')}}"></script>
    <script src="{{ URL('assets/dist/js/custom.js')}}"></script>
    <script src="{{ URL('assets/dist/js/pages/dashboard.js')}}"></script>
    <script src="{{ URL('assets/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
    <script src="{{ URL('assets/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
    <script src="{{ URL('assets/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
    <script src="{{ URL::asset('assets/plugins/iCheck/icheck.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <script src="{{ URL::asset('assets/plugins/ladda/spin.min.js')}}"></script>
    <script src="{{ URL::asset('assets/plugins/ladda/ladda.min.js')}}"></script>
    <script src="{{ URL('assets/plugins/jquery-validation/jquery.validate.min.js')}}"></script>

    
    <script>
        Ladda.bind( 'input[type=submit]' );
        $(function () {
            $('.select2').select2();
            //Flat red color scheme for iCheck
            $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
                checkboxClass: 'icheckbox_flat-green',
                radioClass   : 'iradio_flat-green'
            });
        });
    </script>

    @yield('jquery')

</body>
</html>
