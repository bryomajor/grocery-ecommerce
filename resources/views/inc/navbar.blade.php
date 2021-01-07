<nav class="navbar navbar-expand-md navbar-light fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggler" data-toggle="collapse"
              data-target="#bs-example-navbar-collapse-1" aria-expanded="false"
              aria-controls="bs-example-navbar-collapse-1" aria-label="
              Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>
            <a class="navbar-brand" href="{{url('/')}}"><img src="{{url('/images/logo.png')}}" height="50"
                alt="Nairogrocers" /></a>
          </div>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                @if(!Auth::guest() && Auth::user()->is_admin)
                    <li class="nav-item">
                        <a href="{{route('products.index')}}" class="nav-link">All Products</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Attributes
                        </a>

                        <div class="dropdown-menu dropdown-menu-right">
                            <a href="{{route('categories.index')}}" class="dropdown-item">Categories</a>
                            <a href="{{route('flavors.index')}}" class="dropdown-item">Flavors</a>
                            <a href="{{route('measurements.index')}}" class="dropdown-item">Sizes</a>
                        </div>
                    </li>
                    <li class="nav-item ml-3">
                        <a href="{{route('products.create')}}" class="nav-link btn btn-sm btn-success">Add Product</a>
                    </li>
                @endif
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="badge badge-pill badge-dark">
                            <i class="fa fa-shopping-cart"></i> {{\Cart::getTotalQuantity()}}
                        </span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" style="width: 450px;">
                        <ul class="list-group m-4">
                            @include('inc.cart-drop')
                        </ul>
                    </div>
                </li>
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
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
                @endguest
            </ul>
        </div>
    </div>
</nav>
