<div>
<div class="content-wrapper mb-3 px-2">
    <div class="content d-flex justify-content-between">
        <h2>{{$course->name}}</h2>
    </div>
</div>
<div class="content-wrapper py-4 px-2 welc">
    <div class="content text-center ">
        <div class="d-flex justify-content-between">
            <h2>{{_('Course Group')}}: {{$classroom->name}}</h2>
            <div class="d-flex align-items-center">
                @if($latest)
                    <a href="#" wire:click="store()" class="btn btn-orange ml-2 px-2" >{{ __('End') }} </a>
                @else
                    <a href="#" wire:click="store()" class="btn btn-orange ml-2 px-2" >{{ __('Next Question') }} <i class='fas fa-chevron-right'></i></a>
                @endif
                
            </div>
        </div>
        <p class="text-justify my-3" style="min-height:50px">{{$current->intro }}</p>
        <div class="row mt-4">
            <div class="col-lg-3 border-right-lg mb-3">
                <h2 class="text-left mb-3">{{$current->identifier}}</h2>
                <h5 class="text-left mb-4">{{$current->question}}</h5>
                @if($current->image )
                <div class="wrapper">
                    <a href="<?php echo Theme::url('storage/questions'); ?>/{{$current->image}}" class="fresco"><i class="fas fa-search"></i></a>
                    <img class="position-relative mx-auto centered" src="<?php echo Theme::url('storage/questions'); ?>/{{$current->image}}">
                </div>
                @endif
            </div>
            <div class="col-lg-6 radio-checks">
                <div class="row">
                    @foreach ($answers as $ind => $answer)
                        <div class="col-lg-6" wire:key="answer-{{ $answer->id }}">
                            <div class="box d-flex border justify-content-between">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" wire:model.defer="answers.{{ $ind }}.resp">
                                    <label class="form-check-label" for="flexCheckChecked">
                                        {{$answer->answer }}
                                    </label>
                                </div>
                                @if($answer->image )
                                    <div class="image-wrapper">
                                        <a href="<?php echo Theme::url('storage/answers'); ?>/{{$answer->image}}" class="fresco"><i class="fas fa-search"></i></a>
                                        <img class="position-relative centered" src="<?php echo Theme::url('storage/answers'); ?>/{{$answer->image}}">
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <img src="/img/girl2.png" class="d-lg-inline d-none">
    </div>
</div>
</div>
