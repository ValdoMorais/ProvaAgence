<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>CAOL - Controle de Atividades Online</title>

	  <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">

    <!-- Date Picker -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap-datepicker.css') }}">

    <!-- MultiSelect -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap-multiselect.css') }}">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container-header">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <strong>CAOL</strong> - Controle de Atividades Online
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    <img src="{{ auth()->user()->avatar }}" alt="" width="30" class="img-circle">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif 
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container-menu">
        		<div class="menu">
        			<div class="icon-top">
        				<a href="#"><img src="images/menu/agence.gif" width="18"><br>
        				Agence</a>
        			</div>
        			<div class="icon-top">
        				<a href="#"><img src="images/menu/task_icon.gif" width="18"><br>
        				Projetos</a>
        			</div>
        			<div class="icon-top">
        				<a href="#"><img src="images/menu/administrativo.gif" width="18"><br>
        				Administ.</a>
        			</div>
        			<div class="icon-top">
        				<a href="{{ url('comercial') }}"><img src="images/menu/comercial.gif" width="18"><br>
        				Comercial</a>
        			</div>
        			<div class="icon-top">
        				<a href="#"><img src="images/menu/fichario.gif" width="18"><br>
        				Financeiro</a>
        			</div>
        			<div class="icon-top">
        				<a href="#"><img src="images/menu/info_pessoa.gif" width="18"><br>
        				Usuário</a>
        			</div>
        			<div class="icon-top">
        				<a href="#"><img src="images/menu/cancel.gif" width="18"><br>
        				Sair</a>
        			</div>
        		</div>
            <div class="menu-logo">
              <a href="http://www.agence.com.br/" target=_blank>
                <img alt="" src="images/logo.gif" border=0>
              </a>
            </div>
        </div>

        @yield('content')

    </div>

    <!-- Scripts -->
  	<script type="text/javascript" src="{{ asset('js/jquery.js') }}"></script>
  	<script type="text/javascript" src="{{ asset('js/bootstrap.js') }}"></script>

  	<!-- App -->
  	<script type="text/javascript" src="{{ asset('js/app.js') }}"></script>

    <!-- Páginas Ajax -->
  	<script type="text/javascript" src="{{ asset('js/paginas_consultores.js') }}"></script>
  	<script type="text/javascript" src="{{ asset('js/paginas_clientes.js') }}"></script>

    <!-- Date Picker -->
  	<script type="text/javascript" src="{{ asset('js/bootstrap-datepicker.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/daterange.js') }}"></script>

    <!-- MultiSelect -->
    <script type="text/javascript" src="{{ asset('js/bootstrap-multiselect.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/multiselect.js') }}"></script>
</body>
</html>
