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

    <div id="accordion" class="mt-3">
        <div class="card accordion-item">
            <div class="card-header" id="headingOne">
                <div class="row m-0">
                    <div class="col-md-3 p-1">
                        <div class="box">
                            <h4>{{ __('What is the name of the figure?') }}</h4>
                            <button class="collapsed mt-3" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">{{ __('Answers') }}</button> 
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
                                <p class="value">8 {{ __('Points') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
              <div class="card-body">
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
                            <div class="form-check">
                              <input class="form-check-input" type="checkbox" value="" checked>
                              <label class="form-check-label" for="flexCheckChecked">
                                {{ __('Right Answer') }}
                              </label>
                            </div>
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
                        <a href="#" class="mr-2" wire:click="edit()"><i class='fas fa-edit'></i></a>
                        <a href="#"><i class='far fa-copy'></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="card accordion-item">
            <div class="card-header" id="headingt">
                <div class="row m-0">
                    <div class="col-md-3 p-1">
                        <div class="box">
                            <h4>{{ __('What is the name of the figure?') }}</h4>
                            <button class="collapsed mt-3" type="button" data-toggle="collapse" data-target="#collapset" aria-expanded="true" aria-controls="collapset">{{ __('Answers') }}</button> 
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
                                <p class="value">8 {{ __('Points') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="collapset" class="collapse" aria-labelledby="headingt" data-parent="#accordion">
              <div class="card-body">
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
                            <div class="form-check">
                              <input class="form-check-input" type="checkbox" value="" checked>
                              <label class="form-check-label" for="flexCheckChecked">
                                {{ __('Right Answer') }}
                              </label>
                            </div>
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
                        <a href="#" class="mr-2" wire:click="edit()"><i class='fas fa-edit'></i></a>
                        <a href="#"><i class='far fa-copy'></i></a>
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
                                            <label for="name" class="form-label">{{__('Question Identifier')}} <sup class="text-danger">*</sup></label>
                                            <input wire:model="name" type="text" class="form-control" placeholder="{{_('Ex Question 1')}}" :errors="$errors" autocomplete="off" />
                                            @error('name') <span class="error">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6">
                                        <div class="form-group">
                                            <label for="q_value" class="form-label">{{__('Value')}} <sup class="text-danger">*</sup></label>
                                            <input wire:model="q_value" type="number" class="form-control"  :errors="$errors" autocomplete="off" />
                                            @error('q_value') <span class="error">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group mb-lg-0">
                                            <label for="image" class="form-label">{{__('Image')}} </label>
                                            <div class="img-wrapper">
                                                <a href="#"><i class="fas fa-plus"></i> {{ __('Add image') }}</a>
                                            </div>
                                            @error('image') <span class="error">{{ $message }}</span> @enderror
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
                                            <label for="question" class="form-label">{{__('Question')}} <sup class="text-danger">*</sup></label>
                                            <input wire:model="question" type="text" class="form-control"  :errors="$errors" autocomplete="off" />
                                            @error('question') <span class="error">{{ $message }}</span> @enderror
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
                <button type="button" wire:click.prevent="showAForm" class="btn btn-white btn-fix-size" ><i class='fas fa-plus-circle'></i> {{__('Add Answers')}}</button>
            </div>
        </div>
    </div>
</div>

<!-- edit question modal -->
<div wire:ignore.self class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
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
                                    <div class="col-lg-4 col-md-6">
                                        <div class="form-group">
                                            <label for="name" class="form-label">{{__('Question Identifier')}} <sup class="text-danger">*</sup></label>
                                            <input wire:model="name" type="text" class="form-control" placeholder="{{_('Ex Question 1')}}" :errors="$errors" autocomplete="off" />
                                            @error('name') <span class="error">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6">
                                        <div class="form-group">
                                            <label for="q_value" class="form-label">{{__('Value')}} <sup class="text-danger">*</sup></label>
                                            <input wire:model="q_value" type="number" class="form-control"  :errors="$errors" autocomplete="off" />
                                            @error('q_value') <span class="error">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group mb-lg-0">
                                            <label for="image" class="form-label">{{__('Image')}} </label>
                                            <div class="img-wrapper">
                                                <a href="#"><i class="fas fa-plus"></i> {{ __('Add image') }}</a>
                                            </div>
                                            @error('image') <span class="error">{{ $message }}</span> @enderror
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
                                            <label for="question" class="form-label">{{__('Question')}} <sup class="text-danger">*</sup></label>
                                            <input wire:model="question" type="text" class="form-control"  :errors="$errors" autocomplete="off" />
                                            @error('question') <span class="error">{{ $message }}</span> @enderror
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
                                <input wire:model="answer" type="text" class="form-control" :errors="$errors" autocomplete="off" />
                                @error('answer') <span class="error">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="next_question" class="form-label">{{__('Next Question')}} </label>
                                <select wire:model="next_question" class="form-control" aria-label="" :errors="$errors">
                                    <option value='' selected>{{__('Select Next')}}</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                </select>
                                @error('next_question') <span class="error">{{ $message }}</span> @enderror
                                <small class="text-danger "><em><span class="text-muted">{{__('To assign the next question you need to create it first')}}</span></em></small>
                            </div>
                            
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="image" class="form-label">{{__('Image')}} </label>
                                <input wire:model="image" type="file" class="form-control-file" :errors="$errors" autocomplete="off" />
                                @error('image') <span class="error">{{ $message }}</span> @enderror
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
                <div wire:loading.remove wire:target="store">
                    <button type="button" wire:click.prevent="storeAns" class="btn btn-orange btn-fix-size" >{{__('Save Answer')}}</button>
                </div>
                <button type="button" class="btn btn-white btn-fix-size" wire:click="closeA" data-dismiss="modal">{{__('Cancel')}}</button>
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
    </script>
@endpush