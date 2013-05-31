<html>

  <head>

  </head>

  <body>

    @section('navigation')
      {{-- Navigation-bar --}}
    @show

    <div class="header">
      @yield('header')
    </div>

    <div class="content">
      @yield('content')
    </div>

  </body>

</html>
