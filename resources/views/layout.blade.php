<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">

    <!-- jquery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <title>@yield('pageTitle')</title>
</head>
<style>
    body {
        font-family: 'Nunito', sans-serif;
    }
    
</style>

<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light col-lg-12">
  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
    <a class="navbar-nav nav-item nav-link active" href="{{ route('home') }}">Home</a>
    <div class="navbar-nav ml-auto">
      <a class="nav-item nav-link " href="{{ route('inventory') }}">Inventory</a>
      <a class="nav-item nav-link" href="{{ route('orders') }}">Orders</a>
    </div>
  </div>
</nav>


<div class="container-fluid">
    @yield('content')
</div>




    @yield('scripts')


    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>