    <!DOCTYPE html>
    <html lang="{{ app()->getLocale() }}">
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
	  <link rel="shortcut icon" href="{{ asset('assets/img/logo.jpg')}}"/>
    <link rel='stylesheet' href="{{ asset('assets/css/all.css') }}" integrity='sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/' crossorigin='anonymous'>
    <link href='{{asset('assets/css/fonts-material-icons.css')}}' rel='stylesheet' type='text/css'>
    <link href='{{asset('assets/css/fonts-roboto.css')}}' rel='stylesheet' type='text/css'>
    {{-- <link rel="stylesheet" href="{{ asset('assets/font-awesome/css/font-awesome.min.css') }}"> --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstap3_4/bootstrap.min.css') }}">

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
            <form class="navbar-form navbar-left" action="#">
              <div class="input-group" style="size: 50px;">
                <input type="text" class="form-control"  placeholder="Buscar" name="search">
                <div class="input-group-btn">
                  <button class="btn btn-primary" type="submit">
                    <i class="glyphicon glyphicon-search"></i>
                  </button>
                </div>
              </div>
            </form>
            <div class="navbar-header-left">
              <a class="navbar-brand" href="/">Salir</a>
            </div>
          </div>
        </nav>
      </header>
      <tbody>
        <div class="container-fluid text-center">    
          <div class="row content">
            <nav class="navbar navbar-inverse">
              <div class="container-fluid">
                <ul class="nav navbar-nav">
                  <li class="active"><a href="#">Inicio</a></li>
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

            <div class="col-sm-8 text-left">
              @yield('block')
            </div>
            <div class="col-sm-2 sidenav">
              <div style="text-align:center;padding:1em 0;"> <h4><a style="text-decoration:none;" href="https://www.zeitverschiebung.net/es/country/ve"><span style="color:gray;">Hora actual en</span><br />Colombia</a></h4> <iframe src="https://www.zeitverschiebung.net/clock-widget-iframe-v2?language=es&size=small&timezone=America%2FBogota" width="100%" height="90" frameborder="0" seamless></iframe> </div>
            </div>
          </div>
        </div>
      </tbody>
      <footer class="container-fluid text-center">
      <p style="color: white;">Elaborado por <br><EM>Proyecto MARK</p>
      @yield('footer')
      </footer>
    @yield('script')
  </body>
</html>