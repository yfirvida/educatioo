<div>
    @if (session()->has('message'))
        <div class="alert alert-success" style="margin-top:30px;">
          {{ session('message') }}
        </div>
     @endif
    <div class="content-wrapper">
        <div class="content ">
            <h2 class="mb-3">{{ __('Edit Course') }}</h2>
            <h5 class="">{{ __('Course Name') }} <sup class="text-danger">*</sup></h5>
                <input wire:model="name" type="text" class="dotted-input w-100 mt-2"  autocomplete="off" />
                @error('name') <span class="error">{{ $message }}</span> @enderror
            <h5 class="mt-3">{{ __('Instruction') }} <sup class="text-danger">*</sup></h5>
                <textarea wire:model="description" rows="3" name="description" class="dotted-input w-100 mt-2"   autocomplete="off" /></textarea> 
                @error('description') <span class="error">{{ $message }}</span> @enderror
            <div class="form-group">
                <h5 class="mb-1 mt-2">{{__('Level')}} <sup class="text-danger">*</sup></h5>
                <select wire:model="level_id" id="level_id" class="form-control" >
                    <option value="">{{__('Choose an option')}}</option>
                    @if(!empty($levels))
                        @foreach($levels as $option)
                            <option value="{{ $option->id }}">{{ $option->level }}</option>
                        @endforeach
                    @endif
                </select>
                @error('level_id') <span class="error">{{ $message }}</span> @enderror
            </div>
        </div>
    </div>
    @error('image') 
        <div class="alert alert-danger" style="margin-top:30px;">
          {{ $message }}
        </div>
     @enderror

    <div id="accordion" class="mt-3">
        @if($questions && $questions->count() > 0) 
            @foreach ($questions as $index => $question)
                <div class="card accordion-item" wire:key="question-{{ $question->id }}">
                    <div class="card-header" id="heading{{$index}}">
                        <div class="row m-0">
                            <div class="col-md-3 p-1 order-3 order-md-1">
                                <div class="box">
                                    <h4>{{$question->question }}</h4>
                                    <button class="collapsed mt-3" type="button" data-toggle="collapse" data-target="#collapse{{$index}}" aria-expanded="true" aria-controls="collapse{{$index}}">{{ __('Answers') }}</button> 
                                </div>
                            </div>
                            <div class="col-md-3 p-1 order-2">
                                <div class="box">
                                    <div class="img-wrapper">
                                        <a href="#" class="add-image" wire:click="indexImage({{ $index }})"><i class="fas fa-plus"></i> {{ __('Add image') }}</a>
                                        <div class="wrapper">

                                            @if (!empty($images_temp[$index]))
                                                <img src="{{ $images_temp[$index]->temporaryUrl() }}">
                                            @else
                                                @if($question->image != null)
                                                    <img src="<?php echo Theme::url('storage/questions'); ?>/{{$question->image}}">
                                                @endif
                                            @endif
                                        
                                        </div>
                                        <input type="file" class="fileI" name="imageFile" wire:model="image" style="display:none" accept="image/*"/>
                                    </div>
                                </div>
                                @error('image') <span class="error">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-3 p-1 order-1 order-md-3">
                                <div class="box d-flex justify-content-center align-items-center">
                                    <div class="text-center">
                                        <h4>{{ $question->identifier}}</h4>
                                        <p class="value">{{ $question->value }} {{ __('Points') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="collapse{{$index}}" class="collapse" aria-labelledby="heading{{$index}}" data-parent="#accordion">
                      <div class="card-body">
                        @if($question->answers && $question->answers->count() > 0)
                            @foreach ($question->answers as $ind => $answer)
                                <div class="row m-0" wire:key="answer-{{ $answer->id }}">
                                    <div class="col-md-3 p-1">
                                        <div class="box">
                                            <textarea rows="4" class="form-control w-100" wire:model.defer="questions.{{$index}}.answers.{{ $ind }}.answer"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-3 p-1">
                                        <div class="box">
                                            <div class="img-wrapper">
                                                <a href="#" class="add-image" wire:click="indexImageA({{ $answer->id }})"><i class="fas fa-plus"></i> {{ __('Add image') }}</a>
                                                <div class="wrapper">
                                                     @if (!empty($imagesA_temp[$answer->id]))
                                                        <img src="{{ $imagesA_temp[$answer->id]->temporaryUrl() }}">
                                                    @else
                                                        @if($answer->image != null)
                                                            <img src="<?php echo Theme::url('storage/answers'); ?>/{{$answer->image}}">
                                                        @endif
                                                    @endif
                                                </div>
                                                <input type="file" class="fileI" name="imageFile" wire:model="answerImage"  style="display:none" accept="image/*" />
                                            </div>
                                        </div>
                                         @error('answerImage') <span class="error">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="col-md-3 p-1">
                                        <div class="box">
                                            <select class="form-select" wire:model.defer="questions.{{$index}}.answers.{{ $ind }}.next_question">
                                                <option value="">{{__('Choose an option')}}</option>
                                                    @if(!empty($questions))
                                                        @foreach($questions as $q)
                                                            @if($q->id != $question->id)
                                                                <option value="{{ $q->id }}">{{ $q->identifier }}</option>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                            </select>
                                            <div class="form-check">
                                              <input class="form-check-input" type="checkbox"  wire:model.defer="questions.{{$index}}.answers.{{ $ind }}.correct" >
                                              <label class="form-check-label" for="">
                                                {{ __('Right Answer') }}
                                              </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="row m-0">
                                <div class="col-9 p-1">
                                    <div class="box">
                                        {{_('There are no answers yet')}} 
                                    </div>
                                </div>
                            </div>
                        @endif
                      </div>
                    </div>
                    <div class="col-md-3 p-1 opt">
                        <div class="box text-center">
                            <div class="form-check first-checks">
                                <input wire:model.defer="questions.{{$index}}.first_question" class="form-check-input" type="checkbox" value=""  wire:click="Is_first({{$question->id}}, {{ $index}})">
                                <label class="form-check-label" for="flexCheckDefault">
                                    {{ __('First question') }}
                                </label>
                            </div>
                            <div class="form-check last-checks">
                                <input wire:model.defer="questions.{{$index}}.latest_question" class="form-check-input" type="checkbox" value=""  wire:click="Is_last({{$question->id}}, {{ $index}})">
                                <label class="form-check-label" for="flexCheckDefault">
                                    {{ __('Last question') }}
                                </label>
                            </div>
                            <div class="form-check">
                                <input wire:model.defer="questions.{{$index}}.show_in_result" class="form-check-input" type="checkbox"  wire:click="Is_show({{$question->id}}, {{ $index}})">
                                <label class="form-check-label" for="flexCheckDefault">
                                    {{ __('Show in results') }}
                                </label>
                            </div>
                            <div class="icons-wrapper mt-2">
                                <a href="#" class="mr-2" wire:click="confirm({{$question->id}})"><i class="far fa-trash-alt"></i></a>
                                <a href="#" class="mr-2" wire:click="editQ({{$question->id}})"><i class='fas fa-edit'></i></a>
                                <a href="#" class="mr-2" wire:click="copy({{$question->id}})"><i class='far fa-copy'></i></a>
                                <a href="#"  wire:click='showA2Form({{$question->id}})'><i class='fab fa-rocketchat'></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="card accordion-item">
                <div class="card-header" id="headingOne">
                    <div class="row m-0">
                        <div class="col-12 p-1">
                            <div class="box">
                                {{_('There are no questions yet')}} 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
<div class="actions-wrapper p-1 mt-1">
        <div class=" actions pt-2">
           <div class="box text-right"> 
            <button class="btn btn-orange mx-1 btn-fix-size" wire:click="showForm">
                <i class="far fa-question-circle"></i>
                {{ __('Add new question') }}
            </button>
            <a href="#" class="btn btn-white mx-1 btn-fix-size" wire:click="update">   
                {{ __('Save Course') }}
            </a>
            </div>
        </div>
    </div>
<!-- add new question modal -->
<div wire:ignore.self class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg mw-800" role="document">
        <div class="modal-content">
            <div class="modal-header py-3">
                <h3 class="modal-title">{{__('Add New Question')}}</h3>
                <button type="button" class="close" wire:click="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body pt-3">
                <div class="inside-form">
                    <div class="row">
                        <div class="col-12">
                            <div class="question-wrapper">
                                <div class="row">
                                    <div class="col-lg-4 col-md-6">
                                        <div class="form-group">
                                            <label for="nameq" class="form-label">{{__('Question Identifier')}} <sup class="text-danger">*</sup></label>
                                            <input wire:model="nameq" type="text" class="form-control" placeholder="{{_('Ex Question 1')}}" autocomplete="off" />
                                            @error('nameq') <span class="error">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6">
                                        <div class="form-group">
                                            <label for="q_value" class="form-label">{{__('Value')}} <sup class="text-danger">*</sup></label>
                                            <input wire:model="q_value" type="number" class="form-control"  autocomplete="off" />
                                            @error('q_value') <span class="error">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group mb-lg-0">
                                            <label for="image" class="form-label">{{__('Image')}} </label>
                                            <div class="img-wrapper">
                                                <a href="#" class="add-image"><i class="fas fa-plus"></i> {{ __('Add image') }}</a>
                                                @if ($image != null)
                                                    <img class="form-img ml-3" src="{{ $image->temporaryUrl() }}"> 
                                                @endif
                                                <input type="file" class="fileI" name="imageFile" wire:model="image"  style="display:none" accept="image/*"/>
                                            </div>
                                            @error('image') <span class="error">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="explanation" class="form-label">{{__('Explanation')}} </label>
                                            <textarea  wire:model="explanation" rows="6" class="form-control"   ></textarea>
                                            @error('explanation') <span class="error">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-8">
                                        <div class="form-group">
                                            <label for="question_name" class="form-label">{{__('Question')}} <sup class="text-danger">*</sup></label>
                                            <input wire:model="question_name" type="text" class="form-control"  :errors="$errors" autocomplete="off" />
                                            @error('question_name') <span class="error">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class="col-4 check-group">
                                        <div class="form-check">
                                            <input wire:model="firstQ" class="form-check-input" type="checkbox" >
                                            <label class="form-check-label" for="firstQ">
                                                {{ __('First question') }}
                                            </label>
                                            @error('firstQ') <span class="error">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="form-check">
                                            <input wire:model="latestQ" class="form-check-input" type="checkbox" >
                                            <label class="form-check-label" for="latestQ">
                                                {{ __('Last question') }}
                                            </label>
                                            @error('latestQ') <span class="error">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="form-check">
                                            <input wire:model="showR" class="form-check-input" type="checkbox" >
                                            <label class="form-check-label" for="showR">
                                                {{ __('Show in results') }}
                                            </label>
                                            @error('showR') <span class="error">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="inside-form mt-1 pb-0">
                        <small class="text-danger"><em><sup >*</sup> <apan class="text-muted">{{__('Required fields')}}</apan></em></small>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div wire:loading wire:target="createModal">
                    <img src="{{ asset('star-admin/images/loading-gif.gif') }}" class="loader" />
                </div>
                <div wire:loading.remove wire:target="store">
                    <button type="button" id="btnqsave" wire:click.prevent="store" class="btn btn-orange btn-fix-size" >{{__('Save Question')}}</button>
                </div>
                <button type="button" id="btnsave" wire:click.prevent="showAForm" class="btn btn-white btn-fix-size" disabled><i class='fas fa-plus-circle'></i> {{__('Add Answers')}}</button>
            </div>
        </div>
    </div>
</div>

<!-- edit question modal -->
<div wire:ignore.self class="modal fade" id="editQModal" tabindex="-1" role="dialog" aria-labelledby="editModalQLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg mw-800" role="document">
        <div class="modal-content">
            <div class="modal-header py-3">
                <h3 class="modal-title">{{__('Edit Question')}}</h3>
                <button type="button" class="close" wire:click="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body pt-3">
                <div class="inside-form">
                    <div class="row">
                        <div class="col-12">
                            <div class="question-wrapper">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nameq" class="form-label">{{__('Question Identifier')}} <sup class="text-danger">*</sup></label>
                                            <input wire:model="nameq" type="text" class="form-control" placeholder="{{_('Ex Question 1')}}"  autocomplete="off" />
                                            @error('nameq') <span class="error">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="q_value" class="form-label">{{__('Value')}} <sup class="text-danger">*</sup></label>
                                            <input wire:model="q_value" type="number" class="form-control"   autocomplete="off" />
                                            @error('q_value') <span class="error">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="explanation" class="form-label">{{__('Explanation')}} </label>
                                            <textarea  wire:model="explanation" class="form-control"  :errors="$errors" ></textarea>
                                            @error('explanation') <span class="error">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="question_name" class="form-label">{{__('Question')}} <sup class="text-danger">*</sup></label>
                                            <input wire:model="question_name" type="text" class="form-control"   autocomplete="off" />
                                            @error('question_name') <span class="error">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="inside-form mt-1 pb-0">
                        <small class="text-danger"><em><sup >*</sup> <apan class="text-muted">{{__('Required fields')}}</apan></em></small>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div wire:loading wire:target="editQModal">
                    <img src="{{ asset('star-admin/images/loading-gif.gif') }}" class="loader" />
                </div>
                <div wire:loading.remove wire:target="updateQ">
                    <button type="button" wire:click.prevent="updateQ({{$current}})" class="btn btn-orange btn-fix-size" >{{__('Save Question')}}</button>
                </div>
                <button type="button" class="btn btn-secondary" wire:click="close" data-dismiss="modal">{{__('Cancel')}}</button>
            </div>
        </div>
    </div>
</div>

<!-- add new answer modal -->
<div wire:ignore.self class="modal fade" id="createAModal" tabindex="-1" role="dialog" aria-labelledby="createAModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg mw-800 " role="document">
        <div class="modal-content">
            <div class="modal-header py-3">
                <h3 class="modal-title">{{__('Add New Answer')}}</h3>
                <button type="button" class="close" wire:click="closeA" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body pt-3">
                <div class="inside-form">
                    <div class="row flex-row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="answer" class="form-label">{{__('Answer')}} <sup class="text-danger">*</sup></label>
                                <input wire:model="answer" type="text" class="form-control"  autocomplete="off" />
                                @error('answer') <span class="error">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row flex-row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="next_question" class="form-label">{{__('Next Question')}} </label>
                                <select wire:model="next_question" class="form-control" aria-label="" >
                                    <option value="">{{__('Choose an option')}}</option>
                                    @if(!empty($questions))
                                        @foreach($questions as $q)
                                            <option value="{{ $q->id }}">{{ $q->identifier }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @error('next_question') <span class="error">{{ $message }}</span> @enderror
                                <small class="text-danger "><em><span class="text-muted">{{__('To assign the next question you need to create it first')}}</span></em></small>
                            </div>
                        </div>
                    </div>
                    <div class="row flex-row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="image" class="form-label">{{__('Image')}} </label>
                                    <div class="img-wrapper">
                                        <a href="#" class="add-image"><i class="fas fa-plus"></i> {{ __('Add image') }}</a>
                                        <input type="file" class="fileI" name="imageFile" wire:model="answerImage"  style="display:none" accept="image/*"/>
                                    </div>
                                @error('answerImage') <span class="error">{{ $message }}</span> @enderror

                                @if ($answerImage != null && !$errors->has('answerImage'))
                                    <figure class=" mt-5"><img  class="extraimage" src="{{ $answerImage->temporaryUrl() }}"> </figure>
                                @endif
                            </div>
                        </div>
                        <div class="col-6 check-group">
                            <div class="form-check">
                                <input wire:model="right" class="form-check-input" type="checkbox" >
                                <label class="form-check-label" for="right">
                                    {{ __('Right Answer') }}
                                </label>
                                @error('right') <span class="error">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                    <div class="inside-form mt-2 pb-3 ">
                        <small class="text-danger"><em><sup >*</sup> <span class="text-muted">{{__('Required fields')}}</span></em></small>
                    </div>
                </div>
            </div>
            <div class="modal-footer"> 
                <div wire:loading wire:target="createAModal">
                    <img src="{{ asset('star-admin/images/loading-gif.gif') }}" class="loader" />
                </div>
                <div wire:loading.remove wire:target="saveAnswer">
                    <button type="button" wire:click.prevent="saveAnswer" class="btn btn-orange btn-fix-size" >{{__('Save Answer')}}</button>
                </div>
                <button type="button" class="btn btn-white btn-fix-size" wire:click="closeA" data-dismiss="modal">{{__('Cancel')}}</button>
            </div>
        </div>
    </div>
</div>

<!-- confirm modal -->
<div wire:ignore.self class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-body pb-3">
                <div class="inside-form text-center">
                    {{_('Are you sure you want to delete this item?')}}
                </div>
            </div>
            <div class="modal-footer justify-content-center">
                <div wire:loading wire:target="deleteQuestion">
                    <img src="{{ asset('star-admin/images/loading-gif.gif') }}" class="loader" />
                </div>
                <div wire:loading.remove wire:target="deleteQuestion">
                    <button type="button" wire:click.prevent="deleteQuestion({{$current}})" class="btn btn-orange btn-fix-size" >{{__('Delete')}}</button>
                </div>
                <button type="button" wire:click.prevent="closeConfirm" class="btn btn-white btn-fix-size" >{{__('Cancel')}}</button>
            </div>
        </div>
    </div>
</div>

</div>

@push('scripts')
    <script>
        window.addEventListener('openModal', event => {         
            $('#createModal').modal('show');
        });
        window.addEventListener('closeModal', event => {
            $('#createModal').modal('hide');
        });
        window.addEventListener('openAnswers', event => {         
            document.getElementById("btnsave").disabled = false;
            document.getElementById("btnqsave").textContent = 'Next Question';
        });
        window.addEventListener('openAModal', event => {         
            $('#createAModal').modal('show');
        });

        window.addEventListener('closeAModal', event => {
            $('#createAModal').modal('hide');
        });

        window.addEventListener('openUpdateModal', event => {           
            $('#editModal').modal('show');
        });

        window.addEventListener('closeUpdateModal', event => {
            $('#editModal').modal('hide');
        });

        window.addEventListener('openConfirmModal', event => {         
            $('#confirmModal').modal('show');
        });

        window.addEventListener('closeConfirmModal', event => {
            $('#confirmModal').modal('hide');
        });

        window.addEventListener('openUpdateQModal', event => {         
            $('#editQModal').modal('show');
        });
        window.addEventListener('closeUpdateQModal', event => {         
            $('#editQModal').modal('hide');
        });

        document.addEventListener('livewire:load', function () {
            $(".img-wrapper").on( "click", ".add-image", function() {
                $(this).parent().find(".fileI").trigger('click');
            });
        });

    </script>
@endpush

