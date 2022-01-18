<nav class="sidebar" id="sidebar">
  <div class="side-wrap">
    <a class="menu-btn {{request()->routeIs('classrooms') ? 'active' : '' }}" href="{{ route('classrooms') }}">
      <div class="text-center">
        <img class="normal" src="/img/classroom.png">
        <img class="active" src="/img/classroom_active.png">
        <span class="menu-title">{{ __('Course Group') }}</span>
      </div>
    </a>
    <a class="menu-btn {{request()->routeIs('courses') || request()->routeIs('newcourse')? 'active' : '' }}" href="{{ route('courses') }}">
      <div class="text-center">
        <img class="normal" src="/img/course.png">
        <img class="active" src="/img/course_active.png">
        <span class="menu-title">{{ __('Courses') }}</span>
      </div>
    </a>
    <a class="menu-btn {{request()->routeIs('results') ? 'active' : '' }}" href="{{ route('results') }}">
      <div class="text-center">
        <img class="normal" src="/img/result.png">
        <img class="active" src="/img/result_active.png">
        <span class="menu-title">{{ __('Results') }}</span>
      </div>
    </a>
    <a class="menu-btn {{request()->routeIs('launch') ? 'active' : '' }}" href="{{ route('launch') }}">
      <div class="text-center">
        <img class="normal" src="/img/launch.png">
        <img class="active" src="/img/launch_active.png">
        <span class="menu-title">{{ __('Launch') }}</span>
      </div>
    </a>
  </div>
</nav>