<div>
    <div class="content-wrapper">
        <div class="content ">
            <h2 class="mb-3">{{ __('New Course') }}</h2>
            <h5 class="">{{ __('Course Name') }}</h5>
                <input type="text" name="name" class="dotted-input w-100 mb-3 mt-2" >
            <h5 >{{ __('Instruction') }}</h5>
                <textarea rows="3" class="dotted-input w-100 mt-2"></textarea> 
        </div>
    </div>
    <div class="accordion mt-3" id="questions" >
        <div class="accordion-item">
            <div class="accordion-header" id="headingOne">
                <div class="row m-0">
                    <div class="col-md-3 p-1">
                        <div class="box">
                            <h4>{{ __('What is the name of the figure?') }}</h4>
                            <button class="collapsed mt-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false"  aria-controls="collapseOne">{{ __('Answers') }}</button> 
                        </div>
                    </div>
                    <div class="col-md-3 p-1">
                        <div class="box">
                            <div class="img-wrapper">
                                <a href="#"><i class="fas fa-plus"></i> {{ __('Add image') }}</a>
                                <div class="wrapper"><img src=""></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 p-1">
                        <div class="box d-flex justify-content-center align-items-center">
                            <div class="text-center">
                                <h4>{{ __('Question 1') }}</h4>
                                <p class="value">{{ __('Value') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#questions">
                <div class="accordion-body p-0">
                    <div class="row m-0">
                        <div class="col-md-3 p-1">
                            <div class="box">
                                <textarea rows="4" class="form-control w-100">Curabitur ullamcorper ultricies nisi. </textarea>
                            </div>
                        </div>
                        <div class="col-md-3 p-1">
                            <div class="box">
                                <div class="img-wrapper">
                                    <a href="#"><i class="fas fa-plus"></i> {{ __('Add image') }}</a>
                                    <div class="wrapper"><img src=""></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 p-1">
                            <div class="box">
                                <select class="form-select" aria-label="    ">
                                    <option selected>Question 2</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                </select>
                                <input type="text" name="" class="form-control mt-2" value="8">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 p-1 opt">
                <div class="box text-center">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                            {{ __('Last question') }}
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                            {{ __('Show in results') }}
                        </label>
                    </div>
                    <div class="icons-wrapper mt-2">
                        <a href="#" class="mr-2"><i class="far fa-trash-alt"></i></a>
                        <a href="#"><i class="far fa-edit"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <div class="accordion-header" id="headingt">
                <div class="row m-0">
                    <div class="col-md-3 p-1">
                        <div class="box">
                            <h4>{{ __('What is the name of the figure?') }}</h4>
                            <button class="collapsed mt-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapset" aria-expanded="false"  aria-controls="collapset">{{ __('Answers') }}</button> 
                        </div>
                    </div>
                    <div class="col-md-3 p-1">
                        <div class="box">
                            <div class="img-wrapper">
                                <a href="#"><i class="fas fa-plus"></i> {{ __('Add image') }}</a>
                                <div class="wrapper"><img src=""></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 p-1">
                        <div class="box d-flex justify-content-center align-items-center">
                            <div class="text-center">
                                <h4>{{ __('Question 1') }}</h4>
                                <p class="value">{{ __('Value') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="collapset" class="accordion-collapse collapse" aria-labelledby="headingt" data-bs-parent="#questions">
                <div class="accordion-body p-0">
                    <div class="row m-0">
                        <div class="col-md-3 p-1">
                            <div class="box">
                                <textarea rows="4" class="form-control w-100">Curabitur ullamcorper ultricies nisi. </textarea>
                            </div>
                        </div>
                        <div class="col-md-3 p-1">
                            <div class="box">
                                <div class="img-wrapper">
                                    <a href="#"><i class="fas fa-plus"></i> {{ __('Add image') }}</a>
                                    <div class="wrapper"><img src=""></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 p-1">
                            <div class="box">
                                <select class="form-select" aria-label="    ">
                                    <option selected>Question 2</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                </select>
                                <input type="text" name="" class="form-control mt-2" value="8">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 p-1 opt">
                <div class="box text-center">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                            {{ __('Last question') }}
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                            {{ __('Show in results') }}
                        </label>
                    </div>
                    <div class="icons-wrapper mt-2">
                        <a href="#" class="mr-2"><i class="far fa-trash-alt"></i></a>
                        <a href="#"><i class="far fa-edit"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="actions-wrapper">
        <div class="col-md-3 offset-9 actions">
           <div class="box text-center"> 
            <button class="btn btn-orange w-100" wire:click="showForm">
                <i class="far fa-question-circle mr-2"></i>
                {{ __('Add new question') }}
            </button>
            <a href="#" class="btn btn-white w-100 mt-2">   
                {{ __('Save Course') }}
            </a>
            </div>
        </div>
    </div>

<!-- add new  modal -->
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
                    <div class="row flex-row">
                        <div class="col-lg-4">
                            <div class="question-wrapper">
                                <div class="form-group">
                                    <label for="name" class="form-label">{{__('Question Identifier')}} <sup class="text-danger">*</sup></label>
                                    <input wire:model="name" type="text" class="form-control" placeholder="{{_('Ex Question 1')}}" :errors="$errors" autocomplete="off" />
                                    @error('name') <span class="error">{{ $message }}</span> @enderror
                                </div>
                                <div class="form-group">
                                    <label for="question" class="form-label">{{__('Question')}} <sup class="text-danger">*</sup></label>
                                    <input wire:model="question" type="text" class="form-control"  :errors="$errors" autocomplete="off" />
                                    @error('question') <span class="error">{{ $message }}</span> @enderror
                                </div>
                                <div class="form-group">
                                    <label for="q_value" class="form-label">{{__('Value')}} <sup class="text-danger">*</sup></label>
                                    <input wire:model="q_value" type="number" class="form-control"  :errors="$errors" autocomplete="off" />
                                    @error('q_value') <span class="error">{{ $message }}</span> @enderror
                                </div>
                                <div class="form-group mb-lg-0">
                                    <label for="image" class="form-label">{{__('Image')}} </label>
                                    <div class="img-wrapper">
                                        <a href="#"><i class="fas fa-plus"></i> {{ __('Add image') }}</a>
                                    </div>
                                    @error('image') <span class="error">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="answers-wrapper">
                                <div class="row">
                                    <div class="col-lg-4 px-1">
                                        <div class="form-group">
                                            <label for="answer" class="form-label">{{__('Answer')}} <sup class="text-danger">*</sup></label>
                                            <input wire:model="answer" type="text" class="form-control" :errors="$errors" autocomplete="off" />
                                            @error('answer') <span class="error">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-2 px-1">
                                        <div class="form-group">
                                            <label for="avalue" class="form-label">{{__('Value')}} <sup class="text-danger">*</sup></label>
                                            <input wire:model="avalue" type="text" class="form-control" :errors="$errors" autocomplete="off" />
                                            @error('avalue') <span class="error">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-3 px-1">
                                        <div class="form-group">
                                            <label for="next" class="form-label">{{__('Next Question')}} </label>
                                            <select wire:model="next" class="form-control" aria-label="" :errors="$errors">
                                                <option value='' selected>{{__('Select Next')}}</option>
                                                <option value="1">One</option>
                                                <option value="2">Two</option>
                                            </select>
                                            @error('avalue') <span class="error">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-3 px-1">
                                        <div class="form-group">
                                            <label for="aimage" class="form-label">{{__('Image')}} </label>
                                            <input wire:model="aimage" type="file" class="form-control-file" :errors="$errors" autocomplete="off" />
                                            @error('aimage') <span class="error">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4 px-1">
                                        <div class="form-group">
                                            <label for="answer1" class="form-label">{{__('Answer')}} <sup class="text-danger">*</sup></label>
                                            <input wire:model="answer1" type="text" class="form-control" :errors="$errors" autocomplete="off" />
                                            @error('answer1') <span class="error">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-2 px-1">
                                        <div class="form-group">
                                            <label for="avalue1" class="form-label">{{__('Value')}} <sup class="text-danger">*</sup></label>
                                            <input wire:model="avalue1" type="text" class="form-control" :errors="$errors" autocomplete="off" />
                                            @error('avalue1') <span class="error">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-3 px-1">
                                        <div class="form-group">
                                            <label for="next1" class="form-label">{{__('Next Question')}} </label>
                                            <select wire:model="next1" class="form-control" aria-label="" :errors="$errors">
                                                <option value='' selected>{{__('Select Next')}}</option>
                                                <option value="1">One</option>
                                                <option value="2">Two</option>
                                            </select>
                                            @error('next1') <span class="error">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-3 px-1">
                                        <div class="form-group">
                                            <label for="aimage1" class="form-label">{{__('Image')}} </label>
                                            <input wire:model="aimage1" type="file" class="form-control-file" :errors="$errors" autocomplete="off" />
                                            @error('aimage1') <span class="error">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4 px-1">
                                        <div class="form-group">
                                            <label for="answer2" class="form-label">{{__('Answer')}} <sup class="text-danger">*</sup></label>
                                            <input wire:model="answer2" type="text" class="form-control" :errors="$errors" autocomplete="off" />
                                            @error('answer2') <span class="error">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-2 px-1">
                                        <div class="form-group">
                                            <label for="avalue2" class="form-label">{{__('Value')}} <sup class="text-danger">*</sup></label>
                                            <input wire:model="avalue2" type="text" class="form-control" :errors="$errors" autocomplete="off" />
                                            @error('avalue2') <span class="error">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-3 px-1">
                                        <div class="form-group">
                                            <label for="next2" class="form-label">{{__('Next Question')}} </label>
                                            <select wire:model="next2" class="form-control" aria-label="" :errors="$errors">
                                                <option value='' selected>{{__('Select Next')}}</option>
                                                <option value="1">One</option>
                                                <option value="2">Two</option>
                                            </select>
                                            @error('next2') <span class="error">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-3 px-1">
                                        <div class="form-group">
                                            <label for="aimage2" class="form-label">{{__('Image')}} </label>
                                            <input wire:model="aimage2" type="file" class="form-control-file" :errors="$errors" autocomplete="off" />
                                            @error('aimage2') <span class="error">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4 px-1">
                                        <div class="form-group mb-lg-0">
                                            <label for="answer3" class="form-label">{{__('Answer')}} <sup class="text-danger">*</sup></label>
                                            <input wire:model="answer3" type="text" class="form-control" :errors="$errors" autocomplete="off" />
                                            @error('answer3') <span class="error">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-2 px-1">
                                        <div class="form-group mb-lg-0">
                                            <label for="avalue3" class="form-label">{{__('Value')}} <sup class="text-danger">*</sup></label>
                                            <input wire:model="avalue3" type="text" class="form-control" :errors="$errors" autocomplete="off" />
                                            @error('avalue3') <span class="error">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-3 px-1">
                                        <div class="form-group mb-lg-0">
                                            <label for="next3" class="form-label">{{__('Next Question')}} </label>
                                            <select wire:model="next3" class="form-control" aria-label="" :errors="$errors">
                                                <option value='' selected>{{__('Select Next')}}</option>
                                                <option value="1">One</option>
                                                <option value="2">Two</option>
                                            </select>
                                            @error('next3') <span class="error">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-3 px-1">
                                        <div class="form-group mb-lg-0">
                                            <label for="aimage4" class="form-label">{{__('Image')}} </label>
                                            <input wire:model="aimage4" type="file" class="form-control-file" :errors="$errors" autocomplete="off" />
                                            @error('aimage4') <span class="error">{{ $message }}</span> @enderror
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
                    <button type="button" wire:click.prevent="store" class="btn btn-orange btn-fix-size" >{{__('Save Question')}}</button>
                </div>
                <button type="button" class="btn btn-white btn-fix-size" wire:click="close" data-dismiss="modal">{{__('Cancel')}}</button>
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
    </script>
@endpush