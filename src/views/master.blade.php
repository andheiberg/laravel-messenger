<html>

<head>
 <?php /* echo Asset::styles(); */?>
 <?php /*echo Asset::scripts(); */?>

<style>
/* resize violet header */
.jumbotron{
    padding: 15px 0;
}
</style>

</head>


<body>
<h1> Hallo du </h1>

<!-- navbar -->
<div class="navbar navbar-fixed-top">


<div class="navbar-inner">
        <div class="container">
          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        @yield('nav')
        </div>
      </div>

</div>

<!-- navbar ende -->

<header class="jumbotron subhead" id="overview">
  <div class="container">
    @yield('header')
    </div>
</header>

<div class="container">
@yield('content')
</div>
</body>




</html>
