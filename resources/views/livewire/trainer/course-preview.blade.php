<div>
    <div class="content-wrapper">
        <div class="content ">
            <h2 class="mb-1">{{ __('Course') }} {{$name}}</h2>
            <h4 class="mb-3 font-weight-bold">{{ __('Level') }} {{$level}}</h4>
            <h5 >{{ __('Instruction') }}</h5>
                <p  class=" w-100 mt-2">{{$description}}</p> 
        </div>
    </div>
    <div id="accordion" class="mt-3">
        @if($questions->isNotEmpty())
            @foreach ($questions as $index => $question)
                <div class="card accordion-item">
                    <div class="card-header" id="heading{{$index}}">
                        <div class="row m-0">
                            <div class="col-md-3 p-1 order-3 order-md-1">
                                <div class="box">
                                    <h4>{{$question->question }}</h4>
                                    <button class="collapsed mt-3" type="button" data-toggle="collapse" data-target="#collapse{{$index}}" aria-expanded="true" aria-controls="collapseOne">{{ __('Answers') }}</button> 
                                </div>
                            </div>
                            <div class="col-md-3 p-1 order-2">
                                <div class="box">
                                    <div class="img-wrapper">
                                        <a href="#"><i class="fas fa-plus"></i> {{ __('Add image') }}</a>
                                        <div class="wrapper"><img src="<?php echo Theme::url('storage/questions'); ?>/{{$question->image}}"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 p-1 order-1 order-md-3">
                                <div class="box d-flex justify-content-center align-items-center">
                                    <div class="text-center">
                                        <h4>{{ $question->identifier}}</h4>
                                        <p class="value"> {{ $question->value }} {{ __('Points') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="collapse{{$index}}" class="collapse" aria-labelledby="heading{{$index}}" data-parent="#accordion">
                      <div class="card-body">
                         @if($question->answers)
                            @foreach ($question->answers as $answer)
                                <div class="row m-0">
                                        <div class="col-md-3 p-1">
                                            <div class="box">
                                                <p class=" w-100">{{$answer->answer}}</p>
                                            </div>
                                        </div>
                                        <div class="col-md-3 p-1">
                                            <div class="box">
                                                <div class="img-wrapper">
                                                    <div class="wrapper"><img src=""></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 p-1">
                                            <div class="box d-flex justify-content-center align-items-center">
                                                <div class="text-center">
                                                    <h5>{{ __('Next') }}: {{App\Models\Question::questionById($answer->next_question)}}</h5>
                                                    <label class="value"><?php if($answer->correct == 1):?> {{ __('Right Answer') }} <?php endif; ?></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="col-md-3 p-1 opt">
                        <div class="box text-center d-flex align-items-center justify-content-center">
                            <div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault"  disabled <?php if($question->pivot->first_question == 1): echo "checked"; endif; ?> >
                                <label class="form-check-label" for="flexCheckDefault">
                                    {{ __('First question') }}
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault"  disabled <?php if($question->pivot->latest_question == 1): echo "checked"; endif; ?> >
                                <label class="form-check-label" for="flexCheckDefault">
                                    {{ __('Last question') }}
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" disabled  <?php if($question->pivot->show_in_result == 1): echo "checked"; endif; ?> >
                                <label class="form-check-label" for="flexCheckDefault">
                                    {{ __('Show in results') }}
                                </label>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</div>
