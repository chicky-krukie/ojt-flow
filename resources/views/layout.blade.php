<!doctype html>
<html lang="en">

<head>
 @include('metatags')
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