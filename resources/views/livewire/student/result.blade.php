<div class="content-wrapper mb-3 px-2">
    <div class="content d-flex justify-content-between">
        <h2>{{$course->name}}</h2>
    </div>
</div>
<div class="content-wrapper pt-4 pb-0 px-2 welc">
    <div class="content text-center ">
        <div class="d-md-flex justify-content-between">
            <h2>{{_('Course Group')}}: {{$classroom->name}}</h2>
            <div class="d-flex align-items-center justify-content-center">
                {{_('Minimun Score')}}: {{$min}}%
                
            </div>
        </div>
        <h3 class="mb-2 mt-5">{{_('You have finished the quiz')}}</h3>
        <h3 class="mb-4">{{$course->name}}</h3>
        <h1 class="mb-3 mt-4">
            @if($aproved == 'Passed')
                {{_('Congratulations!')}}
            @endif
        </h1>
        <div class="d-lg-flex justify-content-center align-items-center">
            <h1 class="mb-3 mt-4">{{_('Score')}} {{$value}}/{{$min}} %</h1>
            @if($aproved == 'Passed')
                <img class="centered mx-lg-0 mx-auto" src="/img/congrat.png"> 
            @else
                <img class="centered mx-lg-0 mx-auto" src="/img/fail.png"> 
            @endif
            <div>
                <h1 class=" mt-4 <?php if($aproved != 'Passed'): echo 'mb-3'; endif; ?>">{{$aproved}}</h1>
                @if($aproved != 'Passed') <h4 class="pb-lg-0 pb-5">{{_('We are really sorry!')}}</h4>@endif
            </div>
        </div>
        
    </div>
</div>
