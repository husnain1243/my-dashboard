<header>
    <div class="px-3 py-2 border-bottom mb-3 text-white bg-dark">
      <div class="container d-flex flex-wrap justify-content-between">
        <ul class="nav col-12 col-lg-auto my-2 justify-content-center my-md-0 text-small">
            <li><a href="{{route('Dashboard')}}" class="nav-link text-secondary">Home</a></li>
            <li><a href="{{route('SitePages')}}" class="nav-link text-white">Pages</a></li>
            <li><a href="{{route('Blogs')}}" class="nav-link text-white">Blogs</a></li>
            <li><a href="{{route('Services')}}" class="nav-link text-white">Services</a></li>
            <li><a href="{{route('Teams')}}" class="nav-link text-white">Teams</a></li>
            <li><a href="{{route('Forms')}}" class="nav-link text-white">Forms</a></li>
            <li><a href="{{route('Media')}}" class="nav-link text-white">Media</a></li>
        </ul>
        <div class="text-end d-flex gap-3">
            @if (Auth::check())
                <a href="{{ route('logout') }}" class="btn btn-light text-dark me-2">Logout</a>
            @else
                <a href="{{ route('login') }}" class="btn btn-light text-dark me-2">Login</a>
                <a href="{{route('register')}}" class="btn btn-primary bg-dark">Sign-up</a>
            @endif
            <a href="{{route('Site_Settings')}}" class="nav-link text-white">Settings</a>
        </div>
      </div>
    </div>
  </header>
