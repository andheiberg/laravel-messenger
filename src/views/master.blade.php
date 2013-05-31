<html>

  <head>

  </head>

  <body>

    @section('navigation')
      Navigation-Bar
    @show

    <div class="header">
      @yield('header')
    </div>

    <div class="content">
      @yield('content')
    </div>

  </body>

</html>
