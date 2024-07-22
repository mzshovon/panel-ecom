<nav class="navbar navbar-expand-lg navbar-light bg-white w-100 navigation" id="navbar">
    <div class="container">
      <a class="navbar-brand font-weight-bold" href="{{route('home')}}"><img src="{{URL::to('/')}}/public/frontend/images/logo.png" alt="Adrian."
          class="img-fluid"></a>

      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-navbar"
        aria-controls="main-navbar" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse " id="main-navbar">
        <ul class="navbar-nav mx-auto">
          <li class="nav-item active">
            <a class="nav-link" href="{{route('home')}}">Home </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="{{route('about')}}">About Us</a>
          </li>
          <!-- Pages -->
          <li class="nav-item dropdown dropdown-slide">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown4" role="button" data-delay="350"
              data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Categories
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown4">
                @forelse (getCategoryList() as $category)
                    <li><a href="{{route('category-product', ['catId' => $category['id']])}}">{{$category['name']}}</a></li>
                @empty
                    No category found!
                @endforelse
            </ul>
          </li><!-- /Pages -->
          <!-- / Blog -->

          {{-- <li class="nav-item dropdown dropdown-slide">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown3" role="button" data-delay="350"
              data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Shop.
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown3">
              <li><a href="shop-sidebar.html">Shop</a></li>
              <li><a href="product-single.html">Product Details</a></li>
              <li><a href="checkout.html">Checkout</a></li>
              <li><a href="cart.html">Cart</a></li>
              <li><a href="confirmation.html">Confirmation</a></li>
            </ul>
          </li><!-- / Blog --> --}}

          <li class="nav-item">
            <a class="nav-link" href="{{route('contact-us')}}">Contact Us</a>
          </li>

          @guest
            <li class="nav-item">
                <a class="nav-link" href="{{route('login')}}">Login</a>
            </li>
          @endguest

          @auth
            <!-- Account -->
            <li class="nav-item dropdown dropdown-slide">
                <a class="nav-link dropdown-toggle" href="{{route('dashboard')}}" id="navbarDropdown5" role="button" data-delay="350"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Account
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown5">
                    <li><a href="{{route('dashboard')}}">Dahsboard</a></li>
                    <li><a href="{{route('user.orders')}}">Orders</a></li>
                    <li><a href="address.html">Address</a></li>
                    <li><a href="profile-details.html">Profile Details</a></li>
                </ul>
            </li><!-- / Account -->
          @endauth

        </ul>
      </div>
      <!-- Navbar-collapse -->

      <ul class="top-menu list-inline mb-0 d-none d-lg-block" id="top-menu">
        <li class="list-inline-item">
          <a href="#" class="search_toggle" id="search-icon"><i class="tf-ion-android-search"></i></a>
        </li>

        <li class="dropdown cart-nav dropdown-slide list-inline-item">
          <a href="#" class="dropdown-toggle cart-icon" data-toggle="dropdown" data-hover="dropdown">
            <i class="tf-ion-android-cart"></i>
                <span id="cart-count">{{cartCount()}}</span>
          </a>
          <div class="dropdown-menu cart-dropdown">


            <div class="cart-summary">
              <span class="h6">Total</span>
              <span class="total-price h6">0</span>

              <div class="text-center cart-buttons mt-3">
                <a href="{{route('cart.page')}}" class="btn btn-small btn-transparent btn-block">View Cart</a>
                <a href="{{route('cart.checkout')}}" class="btn btn-small btn-main btn-block">Checkout</a>
              </div>
            </div>
          </div>
        </li>
        @auth
            {{-- <li class="list-inline-item"><a href="#"><i class="tf-ion-ios-person mr-3"></i></a></li> --}}
            <li class="list-inline-item"><a href="{{route('logout')}}" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();"><i class="tf-ion-log-out mr-3"></i></a></li>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        @endauth

        @guest
            <li class="list-inline-item"><a href="{{route('login')}}"><i class="tf-ion-log-in mr-3"></i></a></li>
        @endguest
      </ul>
    </div>
  </nav>
