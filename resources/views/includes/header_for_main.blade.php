<nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-top flex-row">
      <div class="text-center  d-flex align-items-center justify-content-start">
        <div>
          <a class="navbar-brand brand-logo d-none d-sm-block" href="{{ route('trainer_dashboard') }}">
            <img src="/star-admin/images/logo.png" alt="logo" />
          </a>
          <a class="navbar-brand brand-logo-mini d-inline d-sm-none" href="{{ route('trainer_dashboard') }}">
            <img src="/star-admin/images/logo-mini.png" alt="logo" />
          </a>
        </div>
        <div class="me-3">
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-bs-toggle="minimize">
            <span class="icon-menu"></span>
          </button>
        </div>
      </div>
      
      <div class="navbar-menu-wrapper d-flex align-items-top"> 
        <ul class="navbar-nav ms-auto">
          <!-- <li class="nav-item dropdown"> 
            <a class="nav-link count-indicator" id="countDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
              <i class="icon-bell"></i>
              <span class="count"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list pb-0" aria-labelledby="countDropdown">
              <a class="dropdown-item py-3">
                <p class="mb-0 font-weight-medium float-left">You have 7 unread mails </p>
                <span class="badge badge-pill badge-primary float-right">View all</span>
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <img src="/star-admin/images/faces/face10.jpg" alt="image" class="img-sm profile-pic">
                </div>
                <div class="preview-item-content flex-grow py-2">
                  <p class="preview-subject ellipsis font-weight-medium text-dark">Marian Garner </p>
                  <p class="fw-light small-text mb-0"> The meeting is cancelled </p>
                </div>
              </a>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <img src="/star-admin/images/faces/face12.jpg" alt="image" class="img-sm profile-pic">
                </div>
                <div class="preview-item-content flex-grow py-2">
                  <p class="preview-subject ellipsis font-weight-medium text-dark">David Grey </p>
                  <p class="fw-light small-text mb-0"> The meeting is cancelled </p>
                </div>
              </a>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <img src="/star-admin/images/faces/face1.jpg" alt="image" class="img-sm profile-pic">
                </div>
                <div class="preview-item-content flex-grow py-2">
                  <p class="preview-subject ellipsis font-weight-medium text-dark">Travis Jenkins </p>
                  <p class="fw-light small-text mb-0"> The meeting is cancelled </p>
                </div>
              </a>
            </div>
          </li> -->
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
                <p class="mb-1 mt-2 font-weight-semibold">{{Auth::user()->name}}</p>
                <p class="mb-1 font-weight-bold">{{Auth::user()->plan}}</p>
                <p class="fw-light text-muted mb-0">{{Auth::user()->email}}</p>
              </div>
              <a href="{{ route('my-profile') }}" class="dropdown-item justify-content-center"><i class="dropdown-item-icon mdi mdi-power text-primary me-2"></i>{{ __('Profile') }}</a>
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