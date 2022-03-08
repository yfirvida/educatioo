<nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-top flex-row">
      <div class="text-center  d-flex align-items-center justify-content-start">
        <div>
          <a class="navbar-brand brand-logo d-none d-sm-block" href="#">
            <img src="/star-admin/images/logo.png" alt="logo" />
          </a>
          <a class="navbar-brand brand-logo-mini d-inline d-sm-none" href="#">
            <img src="/star-admin/images/logo-mini.png" alt="logo" />
          </a>
        </div>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-top"> 
        <ul class="navbar-nav ms-auto">
          <li class="nav-item dropdown  user-dropdown">
            <a class="nav-link" id="UserDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
              <img class="img-xs rounded-circle" src="/star-admin/images/faces/face8.jpg" alt="Profile image"> </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
              <div class="dropdown-header text-center b-bottom">
                <img class="img-md mx-auto rounded-circle" src="/star-admin/images/faces/face8.jpg" alt="Profile image">
                @auth
                  <p class="mb-1 mt-3 font-weight-semibold">{{Auth::user()->name}}</p>
                  <p class="mb-1 font-weight-bold">{{Auth::user()->plan}}</p>
                  <p class="fw-light text-muted mb-0">{{Auth::user()->email}}</p>
                @endauth
              </div>
              <a href="javascript:void" onclick="$('#logout-form').submit();" class="dropdown-item justify-content-center"><i class="dropdown-item-icon mdi mdi-power text-primary me-2"></i>{{ __('Sign Out') }}</a>
            </div>
          </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-bs-toggle="offcanvas">
          <span class="mdi mdi-menu"></span>
        </button>
      </div>
    </nav>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
      @csrf
    </form>