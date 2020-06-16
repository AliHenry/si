<header class="site-header">
  <a href="/" class="brand-main">
    <h2 class="d-none d-md-inline ">S.I Comprehensive Global Nig. Ltd.</h2>
    <h2 class="d-md-none">SICG</h2>
  </a>
  <a href="/" class="nav-toggle">
    <div class="hamburger hamburger--htla">
      <span>toggle menu</span>
    </div>
  </a>

    <ul class="action-list">
      <li>
        <a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icon-fa icon-fa-plus"></i></a>
        <div class="dropdown-menu dropdown-menu-right">
          <a class="dropdown-item" href="#"><i class="icon-fa icon-fa-edit"></i> New Post</a>
          <a class="dropdown-item" href="#"><i class="icon-fa icon-fa-tag"></i> New Category</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#"><i class="icon-fa icon-fa-star"></i> Separated link</a>
        </div>
      </li>
      @permission('view.sells')
      <li>
        <a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icon-fa icon-fa-bank"></i></a>
        <div class="dropdown-menu dropdown-menu-right notification-dropdown">
          <h6 class="dropdown-header">Banks</h6>
          @foreach(get_banks() as $bank)
            <a class="dropdown-item" href="#"><i class="icon-fa icon-fa-bank"></i>{{$bank->acc_no .' - '.$bank->bank_name}}</a>
          @endforeach
        </div>
      </li>
      @endpermission
      <li>
        <a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icon-fa icon-fa-bell"></i></a>
        <div class="dropdown-menu dropdown-menu-right notification-dropdown">
          <h6 class="dropdown-header">Notifications</h6>
          <a class="dropdown-item" href="#"><i class="icon-fa icon-fa-user"></i> New User was Registered</a>
          <a class="dropdown-item" href="#"><i class="icon-fa icon-fa-comment"></i> A Comment has been posted.</a>
        </div>
      </li>
      <li>
        <a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="avatar"><img src="{{productImage(Auth::user()->profile->image)}}" alt="Avatar"></a>
        <div class="dropdown-menu dropdown-menu-right notification-dropdown">
          <a class="dropdown-item" href="{{route('profile')}}"><i class="icon-fa icon-fa-cogs"></i> Profile</a>
          <a class="dropdown-item" href="/logout"><i class="icon-fa icon-fa-sign-out"></i> Logout</a>
        </div>
      </li>
    </ul>
</header>
