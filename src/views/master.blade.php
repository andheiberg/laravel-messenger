<html>

  <head>

  </head>

  <body>

    @section('sidebar')
      Sidebar. Is a section, because maybe it will be extened
      by child-templates
    @show

    <div class="header">
      @yield('header')
    </div>

    <div class="content">
      @yield('content')
    </div>

  </body>
  
</html>
