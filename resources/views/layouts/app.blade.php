    <!DOCTYPE html>
    <html lang="{{ app()->getLocale() }}">
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
	  <link rel="shortcut icon" href="{{ asset('assets/img/logo.jpg')}}"/>
    <link rel='stylesheet' href="{{ asset('assets/css/all.css') }}" integrity='sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/' crossorigin='anonymous'>
    <link href="{{ asset('assets/css/fonts-material-icons.css')}}" rel='stylesheet' type='text/css'>
    <link href="{{ asset('assets/css/fonts-roboto.css')}}" rel='stylesheet' type='text/css'>

      
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/dataTables.bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/estilos.css') }}">
    <!-- Buttons DataTables -->
    <link rel="stylesheet" href="{{ asset('assets/css/buttons.bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/font-awesome.min.css') }}">
  

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstap3_4/bootstrap.min.css') }}">
    
    
    <!-- Bootstrap core JavaScript -->
    <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>


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
                          <li><a href="asesores">Asesor</a></li>
                          <li><a href="clientes">Cliente</a></li>
                          <li><a href="eventos">Evento</a></li>
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
    <script src="{{ asset('assets/js/jquery-1.12.3.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap3_6/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/dataTables.bootstrap.js') }}"></script>
    <!--botones DataTables-->	
    <script src="{{ asset('assets/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/js/buttons.bootstrap.min.js') }}"></script>
    <!--Libreria para exportar Excel-->
    <script src="{{ asset('assets/js/jszip.min.js') }}"></script>
    <!--Librerias para exportar PDF-->
    <script src="{{ asset('assets/js/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/js/vfs_fonts.js') }}"></script>
    <!--Librerias para botones de exportación-->
    <script src="{{ asset('assets/js/buttons.html5.min.js') }}"></script>
    @yield('script')
  </body>
</html>