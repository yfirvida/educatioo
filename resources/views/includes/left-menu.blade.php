<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
    <li class="nav-item {{request()->routeIs('dashboard') ? 'active' : '' }}">
      <a class="nav-link" href="{{ route('dashboard') }}">
        <i class="mdi mdi-grid-large menu-icon"></i>
        <span class="menu-title">{{ __('Dashboard') }}</span>
        <i class="menu-arrow"></i> 
      </a>
    </li>
    <li class="nav-item nav-category">{{ __('Users') }}</li>
    <li class="nav-item {{request()->routeIs('users') ? 'active' : '' }}">
      <a class="nav-link" href="{{ route('users') }}" >
        <i class="menu-icon mdi mdi-account-circle-outline"></i>
        <span class="menu-title">{{ __('Trainers') }}</span>
        <i class="menu-arrow"></i> 
      </a>
    </li>
    <li class="nav-item nav-category">{{ __('Management') }}</li>
    <li class="nav-item {{request()->routeIs('lands') ? 'active' : '' }}">
      <a class="nav-link" href="{{ route('lands') }}" >
        <i class="menu-icon mdi mdi mdi-map-marker"></i>
        <span class="menu-title">{{ __('Lands') }}</span>
        <i class="menu-arrow"></i> 
      </a>
    </li>
    <li class="nav-item {{request()->routeIs('levels') ? 'active' : '' }}">
      <a class="nav-link "  href="{{ route('levels') }}">
        <i class="menu-icon mdi mdi-file-tree"></i>
        <span class="menu-title">{{ __('Levels') }}</span>
        <i class="menu-arrow"></i>
      </a>
    </li>
    <li class="nav-item {{request()->routeIs('plans') ? 'active' : '' }}">
      <a class="nav-link" href="{{ route('plans') }}" >
        <i class="menu-icon mdi mdi-playlist-check"></i>
        <span class="menu-title">{{ __('Plans') }}</span>
        <i class="menu-arrow"></i>
      </a>
    </li>
    <li class="nav-item nav-category">{{ __('Profile') }}</li>
    <li class="nav-item {{request()->routeIs('profile') ? 'active' : '' }}">
      <a class="nav-link" href="{{ route('profile') }}" >
        <i class="menu-icon mdi mdi-account-card-details"></i>
        <span class="menu-title">{{ __('Profile') }}</span>
        <i class="menu-arrow"></i> 
      </a>
    </li>
  </ul>
</nav>