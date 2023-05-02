<!doctype html>
<html lang="en">

<head>

@include('metatags')

<<<<<<< HEAD
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

    <script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.colVis.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css">


    <link rel="stylesheet" href="{{ url('css/custom.css') }}">

    <title>OJT FLOW</title>
=======
>>>>>>> e6ca9497e393c5d1c0a7652dbdd88e8c69a3f20c
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

                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }}
                    </a>

                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
                
            </div>
        </div>
    </nav>


    <div>
        @yield('content')
    </div>




    @stack('scripts')

</body>

</html>

{{-- 
    
<div class="d-flex justify-content-center text-center">
                                    <h6><b>ID's</b></h6>
                                </div>

                                <div class="d-flex justify-content-between">
                                    <h6>Object ID:</h6>
                                    <p><strong>{{ $item['product']['object_id'] }}</strong></p>
                                </div>

                                <div class="d-flex justify-content-between">
                                    <h6>Oracle ID:</h6>
                                    <p><strong>{{ $item['product']['oracle_id'] }}</strong></p>
                                </div>

                                <div class="d-flex justify-content-between">
                                    <h6>Multiverse ID:</h6>
                                    <p><strong>{{ $item['product']['multiverse_ids'] }}</strong></p>
                                </div>

                                <div class="d-flex justify-content-between">
                                    <h6>MTGO ID:</h6>
                                    <p><strong>{{ $item['product']['mtgo_id'] }}</strong></p>
                                </div>

                                <div class="d-flex justify-content-between">
                                    <h6>TCGPLAYER ID:</h6>
                                    <p><strong>{{ $item['product']['tcgplayer_id'] }}</strong></p>
                                </div>

                                <div class="d-flex justify-content-between">
                                    <h6>Card Market ID:</h6>
                                    <p><strong>{{ $item['product']['cardmarket_id'] }}</strong></p>
                                </div>
    
--}}
