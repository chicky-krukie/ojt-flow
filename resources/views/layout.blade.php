<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        integrity="sha512-1JBNehX9mHyYvH8DRmBwOwxxDoM0F33mTQ2O2OxJRYmID9XOz1Yq3NqNwU0vm6teJen6REbN6Ud4a+z4J4LXrQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />


    {{-- <!-- Popup --> --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

    {{-- Orders Delete Pop up --}}
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>

    {{-- DataTables --}}
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

    <script src= "https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
    <script src= "https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
    <script src= "https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src= "https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src= "https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.colVis.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css">

    <link rel="stylesheet" href="{{ url('css/custom.css') }}">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>OJT FLOW</title>
</head>
<style>
    body {
        font-family: 'Nunito', sans-serif;
    }

    .thumbnail {
        height: 14vh;
        width: 7vw;
    }
</style>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light col-lg-12">
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav ml-auto">
                <a class="nav-item nav-link mx-2" href="{{ route('home') }}">Activity Logs
                    <i class="fa fa-history" aria-hidden="true"></i>
                </a>
                <a class="nav-item nav-link mx-2" href="{{ route('inventoryTable') }}">Inventory
                    <i class="fa fa-archive" aria-hidden="true"></i>
                </a>
                <a class="nav-item nav-link mx-2" href="{{ route('orders') }}">Orders
                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                </a>
                <a class="nav-item nav-link mx-2" href="{{ route('settings') }}">Settings
                    <i class="fa fa-cog" aria-hidden="true"></i>
                </a>
            </div>
        </div>
    </nav>


    <div>
        @yield('content')
    </div>




    @stack('scripts')

</body>

</html>