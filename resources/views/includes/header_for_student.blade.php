<nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-top flex-row">
      <div class="text-center  d-flex align-items-center justify-content-start">
        <div>
          <a class="navbar-brand brand-logo d-none d-sm-block" href="{{ route('student_dashboard') }}">
            <img src="/star-admin/images/logo.png" alt="logo" />
          </a>
          <a class="navbar-brand brand-logo-mini d-inline d-sm-none" href="{{ route('student_dashboard') }}">
            <img src="/star-admin/images/logo-mini.png" alt="logo" />
          </a>
        </div>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-top"> 
        <ul class="navbar-nav ms-auto">
          <li class="nav-item dropdown  user-dropdown">
            <a class="nav-link" id="UserDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
               @if(Auth::user()->image != null)
                <img class="img-xs rounded-circle" src="<?php echo Theme::url('uploads'); ?>/{{Auth::user()->image}}" alt="Profile image"> </a>
              @else
                <img class="img-xs rounded-circle" src="/img/profile-image.png" alt="Profile image">
              @endif
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
              <div class="dropdown-header text-center b-bottom">
                @if(Auth::user()->image != null)
                  <img class="img-profile mx-auto rounded-circle" src="<?php echo Theme::url('uploads'); ?>/{{Auth::user()->image}}" alt="Profile image"> </a>
                @else
                  <img class="img-profile mx-auto rounded-circle" src="/img/profile-image.png" alt="Profile image">
                @endif
                @auth
                  <p class="mb-1 mt-3 font-weight-semibold">{{Auth::user()->name}}</p>
                  <p class="mb-1 font-weight-bold">{{Auth::user()->plan}}</p>
                  <p class="fw-light text-muted mb-0">{{Auth::user()->email}}</p>
                @endauth
              </div>
              <a href="{{ route('st-profile') }}" class="dropdown-item justify-content-center"><i class="dropdown-item-icon mdi mdi-power text-primary me-2"></i>{{ __('Profile') }}</a>
              <a href="javascript:void" onclick="$('#logout-form').submit();" class="dropdown-item justify-content-center"><i class="dropdown-item-icon mdi mdi-power text-primary me-2"></i>{{ __('Sign Out') }}</a>
            </div>
          </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-bs-toggle="offcanvas">
          <span class="mdi mdi-menu"></span>
        </button>
      </div>
    </nav>

    <form id="logout-form" action="{{ route('logout-web') }}" method="POST" style="display: none;">
      @csrf
    </form>