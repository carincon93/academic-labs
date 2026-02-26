<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-datepicker.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-datepicker.standalone.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-datepicker.min.css') }}" rel="stylesheet">

    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">

</head>
<body>
    @include('partials.modal')
    @include('partials.modal_historial')
    @auth
        <aside id="sidebar">
            <div id="sidebar-logo">
                <h4 class="text-center">
                    <a href="{{ url('/admin') }}">ALMACÉN CPIC</a>
                </h4>
            </div>
            <div id="sidebar-content">
                <ul class="sidebar-menu list-unstyled">
                    <li>Administración</li>
                    <li>
                        <a href="{{ url('/admin/dashboard') }}"><i class="fa fa-fw fa-cog"></i>Dashboard</a>
                    </li>
                    <li>Administración</li>
                    <li>
                        <a href="{{ url('/admin/collaborator') }}"><i class="fa fa-fw fa-cog"></i>Administradores</a>
                    </li>
                    <li>
                        <a href="{{ url('/admin/instructor') }}"><i class="fa fa-fw fa-cog"></i>Instructores</a>
                    </li>
                    <li>
                        <a href="{{ url('/admin/classroom') }}"><i class="fa fa-fw fa-cog"></i>Ambientes</a>
                    </li>
                    <li>
                        <a href="{{ url('/admin/class_group') }}"><i class="fa fa-fw fa-cog"></i>Grupos</a>
                    </li>
                    <li>Acciones</li>
                    <li>
                        <a href="{{ url('/') }}"><i class="fa fa-fw fa-key icon-cyan"></i>Prestar ambiente</a>
                    </li>
                    <li>
                        <a href="{{ url('/admin/history_record') }}"><i class="fas fa-chart-line"></i>Historial de préstamos</a>
                    </li>
                    <li>
                        <a href="{{ url('/admin/update_system') }}"><i class="fas fa-circle-notch"></i>Actualizar sistema</a>
                    </li>
                </ul>
            </div>
        </aside>
    @endauth
    <main id="app">
        <div class="{{ Auth::check() ? 'app-check' : ''}}">
            {{-- <nav class="navbar navbar-default navbar-fixed-top {{ Auth::check() ? 'mleft' : '' }}">
                <div class="container-fluid">
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav navbar-right">
                            @auth
                                <li><span id="userImage" class="text-uppercase"></span></li>
                                <li class="dropdown">
                                    <a id="nameUser" href="#" class="dropdown-toggle text-capitalize user-name" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->name }}<span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="{{url('admin/password')}}">Cambiar mi contraseña</a></li>
                                        <li role="separator" class="divider"></li>
                                        <li>
                                            <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();" class="">
                                                <i class="fa fa-fw fa-sign-out"></i>
                                                Cerrar Sesión
                                            </a>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                @csrf
                                            </form>
                                        </li>
                                    </ul>
                                </li>
                            @endauth
                        </ul>
                    </div>
                </div>
            </nav> --}}

            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <a class="navbar-brand" href="#">Navbar</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Link</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Dropdown
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link disabled" href="#">Disabled</a>
                        </li>
                    </ul>
                    <form class="form-inline my-2 my-lg-0">
                        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                    </form>
                </div>
            </nav>

            <div class="main-content">
                <div class="row no-gutter">
                    <div class="{{ Auth::guest() ? 'col-md-9' : '' }} big-content">
                        <div class="big-content-desc mt-0">
                            @yield('big-content-desc')
                        </div>
                        @yield('content')
                    </div>
                    <div class="{{ Auth::guest() ? 'col-md-3 right-content' : ''}}">
                        <div>
                            @yield('right-content')

                            @guest
                                <div class="card-form">
                                    <form method="POST" action="{{ route('login') }}">
                                        @csrf

                                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                            <label for="email" class="control-label">Correo electrónico</label>

                                            <div>
                                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                                @if ($errors->has('email'))
                                                    <span class="help-block">
                                                        {{ $errors->first('email') }}
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                            <label for="password" class="control-label">Contraseña</label>

                                            <div>
                                                <input id="password" type="password" class="form-control" name="password" required>

                                                @if ($errors->has('password'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('password') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div>
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Recuerda mi cuenta
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div>
                                                <button type="submit" id="login" class="btn btn-primary">
                                                    Iniciar sesión
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            @endguest
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('js/select2.min.js') }}"></script>
<script src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('js/bootstrap-datepicker.es.min.js') }}"></script>
<script src="{{ asset('js/custom.js') }}"></script>
<script>
    $(window).on('load', function () {
        $('#modalSession').modal({ backdrop: 'static', keyboard: false });
        $('#modalSession').css({
            'display': 'block',
            'opacity': '1'
        });
    });
    $(document).ready(function() {

        var id_anchor = location.hash;
        $(id_anchor).css('border', '1px solid rgb(232, 40, 111)').append('<div class="card clr-msg"><div class="caret"></div>Por favor entrega este ambiente</div>');

        $('.select').select2();
        $('#myTable').DataTable();
        $('.owl-carousel').owlCarousel({
            loop:true,
            // autoplay:true,
            margin:10,
            responsiveClass:true,
            responsive:{
                0:{
                    items:1,
                    nav:true
                },
                1000:{
                    items:1,
                    nav:false,
                    loop:false
                }
            }
        });
        $('.datapickerr').datepicker({
            format: "yyyy/mm/dd",
            language: "es",
            autoclose: true
        });
    });
</script>
</body>
</html>
