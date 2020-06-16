<!-- Header -->
<header class="header shop">
  <!-- Topbar -->
  @include('front.layouts.partials.toolbar')
  <!-- End Topbar -->
  <div class="middle-inner">
    <div class="container">
      <div class="row">
        <div class="col-lg-2 col-md-2 col-12">
          <!-- Logo -->
          <div class="logo">
            <a href="{{route('home')}}"><img height="100px" width="100px" src="{{asset('/assets/front/images/si-logo.png')}}" alt="logo"></a>
          </div>
          <!--/ End Logo -->
          <!-- Search Form -->
          <div class="search-top">
            <div class="top-search"><a href="#0"><i class="ti-search"></i></a></div>
            <!-- Search Form -->
            <div class="search-top">
              <form class="search-form">
                <input type="text" placeholder="Search here..." name="search">
                <button value="search" type="submit"><i class="ti-search"></i></button>
              </form>
            </div>
            <!--/ End Search Form -->
          </div>
          <!--/ End Search Form -->
          <div class="mobile-nav"></div>
        </div>
        <div class="col-lg-8 col-md-7 col-12">
          <div class="search-bar-top">
            <div class="search-bar">
              <select>
                <option selected="selected">All Category</option>
                @foreach($categories as $category)
                  <option value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
              </select>
              <form>
                <input name="search" placeholder="Search Products Here....." type="search">
                <button class="btnn"><i class="ti-search"></i></button>
              </form>
            </div>
          </div>
        </div>
        <div class="col-lg-2 col-md-3 col-12">
          <div class="right-bar">
            <!-- Search Form -->
            <div class="sinlge-bar">
              <a href="#" class="single-icon"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
            </div>
            <div class="sinlge-bar">
              <a href="#" class="single-icon"><i class="fa fa-user-circle-o" aria-hidden="true"></i></a>
            </div>
            <div class="sinlge-bar shopping">
              <a href="#" class="single-icon"><i class="ti-bag"></i> <span class="total-count">2</span></a>
              <!-- Shopping Item -->
              <div class="shopping-item">
                <div class="dropdown-cart-header">
                  <span>2 Items</span>
                  <a href="{{route('cart')}}">View Cart</a>
                </div>
                <ul class="shopping-list">
                  <li>
                    <a href="#" class="remove" title="Remove this item"><i class="fa fa-remove"></i></a>
                    <a class="cart-img" href="#"><img src="https://via.placeholder.com/70x70" alt="#"></a>
                    <h4><a href="#">Woman Ring</a></h4>
                    <p class="quantity">1x - <span class="amount">$99.00</span></p>
                  </li>
                  <li>
                    <a href="#" class="remove" title="Remove this item"><i class="fa fa-remove"></i></a>
                    <a class="cart-img" href="#"><img src="https://via.placeholder.com/70x70" alt="#"></a>
                    <h4><a href="#">Woman Necklace</a></h4>
                    <p class="quantity">1x - <span class="amount">$35.00</span></p>
                  </li>
                </ul>
                <div class="bottom">
                  <div class="total">
                    <span>Total</span>
                    <span class="total-amount">$134.00</span>
                  </div>
                  <a href="{{route('checkout')}}" class="btn animate">Checkout</a>
                </div>
              </div>
              <!--/ End Shopping Item -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Header Inner -->
  <div class="header-inner">
    <div class="container">
      <div class="cat-nav-head">
        <div class="row">
          <div class="col-12">
            <div class="menu-area">
              <!-- Main Menu -->
              <nav class="navbar navbar-expand-lg">
                <div class="navbar-collapse">
                  <div class="nav-inner">
                    <ul class="nav main-menu menu navbar-nav">
                      <li class="{{(request()->is('/') ? 'active' : '')}}"><a href="{{route('home')}}">Home</a></li>
{{--                      <li><a href="#">Product</a></li>--}}
{{--                      <li><a href="#">Service</a></li>--}}
                      <li class="{{(request()->is('shop') ? 'active' : '')}}"><a href="{{route('shop')}}">Shop</a></li>
{{--                      <li><a href="#">Pages</a></li>--}}
{{--                      <li><a href="#">Blog<i class="ti-angle-down"></i></a>--}}
{{--                        <ul class="dropdown">--}}
{{--                          <li><a href="blog-single-sidebar.html">Blog Single Sidebar</a></li>--}}
{{--                        </ul>--}}
{{--                      </li>--}}
                      <li class="{{(request()->is('contact') ? 'active' : '')}}"><a href="{{route('contact')}}">Contact Us</a></li>
                    </ul>
                  </div>
                </div>
              </nav>
              <!--/ End Main Menu -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--/ End Header Inner -->
</header>
<!--/ End Header -->