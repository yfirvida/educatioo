<div class="content-wrapper mb-3 px-2">
    <div class="content d-flex justify-content-between">
        <h2>{{$course->name}}</h2>
    </div>
</div>
<div class="content-wrapper pt-4 pb-0 px-2 welc">
    <div class="content text-center ">
        <div class="d-flex justify-content-between">
            <h2>{{_('Course Group')}}: {{$classroom->name}}</h2>
            <div class="d-flex align-items-center">
                {{_('Minimun Score')}}: {{$min}}%
                
            </div>
        </div>
        <h1 class="mb-3 mt-4">{{_('Congratulations!')}}</h1>
        <h3 class="mb-2">{{_('You have finished the quiz')}}</h3>
        <h3 class="mb-4">{{$course->name}}</h3>
        <div class="d-flex justify-content-center align-items-center">
            <h1 class="mb-3 mt-4">{{_('Score')}} {{$value}}/{{$total}}</h1>
            <img class="centered" src="/img/congrat.png"> 
            <h1 class="mb-3 mt-4">{{$aproved}}</h1>
        </div>
        
    </div>
</div>
