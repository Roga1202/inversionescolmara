    <!DOCTYPE html>
    <html lang="{{ app()->getLocale() }}">
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
	  <link rel="shortcut icon" href="{{ asset('assets/img/logo.jpg')}}"/>
    <link rel='stylesheet' href="{{ asset('assets/css/all.css') }}" integrity='sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/' crossorigin='anonymous'>
    <link href="{{ asset('assets/css/fonts-material-icons.css')}}" rel='stylesheet' type='text/css'>
    <link href="{{ asset('assets/css/fonts-roboto.css')}}" rel='stylesheet' type='text/css'>
    {{-- <link rel="stylesheet" href="{{ asset('assets/font-awesome/css/font-awesome.min.css') }}"> --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstap3_4/bootstrap.min.css') }}">
    
    
<!-- Bootstrap core JavaScript -->
<script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
<script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

<!-- Plugin JavaScript -->
<script src="{{asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>

<!-- Contact form JavaScript -->
<script src="{{asset('js/jqBootstrapValidation.js')}}"></script>
<script src="{{asset('js/contact_me.js')}}"></script>

<!-- Custom scripts for this template -->
<script src="{{asset('js/agency.min.js')}}"></script>

    <script src="{{ asset('assets/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap3_4/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap3_7/bootstrap.min.js') }}"></script>
    
    @yield('head')
    </head>
    <body>
      <header>
        <nav class="navbar navbar-inverse">
          <div class="container-fluid">
            <div class="navbar-header-rigth">
              <a class="navbar-brand" href="proceso">Inversiones Colmara Ltda</a>
            </div>
            <div class="navbar-header-left">
              <a class="navbar-brand" href="/">Salir</a>
            </div>
          </div>
        </nav>
      </header>
      <tbody>
          <div class="panel">
            <div class="col-sm-2">
            <br>
            <br>
            <br>
            <br>
            <br>
              <div class="row">
                <div class="container-fluid text-center">    
                  <div class="row content">
                    <nav class="navbar navbar-inverse">
                      <div class="container-fluid">
                        <ul class="nav navbar-nav">
                          <li class="active"><a href="proceso">Inicio</a></li>
                          <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">Asesor</a>
                            <ul class="dropdown-menu">
                              <li><a href="asesores">Ver</a></li>
                              <li><a href="archivos/asesores">Archivos</a></li>
                            </ul>
                          </li>
                          <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">Cliente</a>
                              <ul class="dropdown-menu">
                                <li><a href="clientes">Ver</a></li>
                                <li><a href="archivos/clientes">Archivos</a></li>
                              </ul>
                          </li>
                          <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">Evento</a>
                            <ul class="dropdown-menu">
                              <li><a href="eventos">Ver</a></li>
                              <li><a href="archivos/clientes">Archivos</a></li>
                            </ul>
                          </li>
                        </ul>
                      </div>
                    </nav>
                  </div>
                </div>
              </div> 
            </div>
            @yield('block')
          </div>
      </tbody>
      <div class="col-sm-12">
        <footer class="container-fluid text-center">
          <p style="color: white;background: black;">Elaborado por <br><EM>Proyecto MARK</p>
          @yield('footer')
        </footer>
      </div>
    @yield('script')
  </body>
</html>