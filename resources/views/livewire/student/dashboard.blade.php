<div>
@if($course)
<div class="content-wrapper mb-3 px-2">
    <div class="content d-flex justify-content-between">
    	<h2>{{$course->name}}</h2> 
    	<h2>{{_('Course Group')}}: {{$classroom->name}}</h2>
    </div>
</div>
@endif
<div class="content-wrapper p-5 welc">
    <div class="content text-center ">
    	<h1 class="mb-2">{{_('Welcome')}}</h1>
    	<h3 class="mb-5">{{$user->name}}</h3>
        @if($course)
        	<h6 class="mb-4">{{_('Instructions')}}</h6> 
        	<p class="text-justify mr-5 pr-5">{{$course->description}}</p>
        	<a href="{{ route('quiz') }}" class="btn btn-orange mx-auto mt-5" >{{ __('Start') }}</a>
        @else
        <p class="text-center">{{_('This course is not active at this moment')}}</p>
        @endif
    	<img src="/img/girl.png">
    </div>
</div>
</div>