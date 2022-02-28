<div>
    <div class="content-wrapper">
        <div class="content b-bottom pb-4">
            <div class="d-flex justify-content-between align-items-center mt-3 ">
                <form class="d-none d-sm-inline-block form-inline mw-100 navbar-search">
                    <div class="input-group">
                        <i class='fas fa-search'></i>
                        <input type="text" class="form-control search-input" placeholder="Search..." >
                    </div>
                </form> 
                <div>
                    <a href="#" wire:click="showForm" class="btn btn-orange btn-fix-size" >
                        <img src="/img/group.png">
                        {{ __('Add new Course Group') }}
                    </a>
                </div> 
                
            </div>
        </div>
        <div class="content">
            <div class="table-responsive mt-4">
                <table class="table  ">
                    <thead>
                        <tr>
                            <th scope="col">{{ __('Name') }}</th>
                            <th scope="col">{{ __('Level') }}</th>
                            <th scope="col">{{ __('Number of students') }}</th>
                            <th scope="col" class="text-center w-25">{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Course Lorem Ipsum</td>
                            <td>Level 1</td>
                            <td class="text-center">6</td>
                            <td class="d-flex justify-content-between align-items-center act">
                                <a href="{{ route('edit-course') }}" class="btn actions mb-2 mr-2"><i class="fas fa-edit"></i> {{ __('Edit') }}</a>
                                <button class="btn actions mb-2 mr-2"><i class="fas fa-minus"></i> {{ __('Delete') }}</button> 
                                <i class='fas fa-ellipsis-h mb-2 text-danger'></i>

                                <div class="action-box">
                                    <button class="btn actions mb-2"><i class="fas fa-clipboard-check mr-1"></i> {{ __('Show questionnaries') }}</button> 
                                    <button class="btn btn-orange mb-2"><i class="fas fa-user-plus"></i> {{ __('Assign students') }}</button> 
                                    <button class="btn actions btn-gray "><i class="fas fa-users mr-1"></i> {{ __('Show students') }}</button> 

                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Course Lorem Ipsum 2</td>
                            <td>Level 2</td>
                            <td class="text-center">7</td>
                            <td class="d-flex justify-content-between align-items-center act">
                                <a href="{{ route('edit-course') }}" class="btn actions mb-2 mr-2"><i class="fas fa-edit"></i> {{ __('Edit') }}</a>
                                <button class="btn actions mb-2 mr-2"><i class="fas fa-minus"></i> {{ __('Delete') }}</button> 
                                <i class='fas fa-ellipsis-h mb-2 text-danger'></i>

                                <div class="action-box">
                                    <button class="btn actions mb-2"><i class="fas fa-clipboard-check mr-1"></i> {{ __('Show questionnaries') }}</button> 
                                    <button class="btn btn-orange mb-2"><i class="fas fa-user-plus"></i> {{ __('Assign students') }}</button> 
                                    <button class="btn actions btn-gray"><i class="fas fa-users mr-1"></i> {{ __('Show students') }}</button> 

                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Course Lorem Ipsum 2</td>
                            <td>Level 2</td>
                            <td class="text-center">7</td>
                            <td class="d-flex justify-content-between align-items-center act">
                                <a href="{{ route('edit-course') }}" class="btn actions mb-2 mr-2"><i class="fas fa-edit"></i> {{ __('Edit') }}</a>
                                <button class="btn actions mb-2 mr-2"><i class="fas fa-minus"></i> {{ __('Delete') }}</button> 
                                <i class='fas fa-ellipsis-h mb-2 text-danger'></i>

                                <div class="action-box">
                                    <button class="btn actions mb-2"><i class="fas fa-clipboard-check mr-1"></i> {{ __('Show questionnaries') }}</button> 
                                    <button class="btn btn-orange mb-2"><i class="fas fa-user-plus"></i> {{ __('Assign students') }}</button> 
                                    <button class="btn actions btn-gray"><i class="fas fa-users mr-1"></i> {{ __('Show students') }}</button> 

                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Course Lorem Ipsum 2</td>
                            <td>Level 2</td>
                            <td class="text-center">7</td>
                            <td class="d-flex justify-content-between align-items-center act">
                                <a href="{{ route('edit-course') }}" class="btn actions mb-2 mr-2"><i class="fas fa-edit"></i> {{ __('Edit') }}</a>
                                <button class="btn actions mb-2 mr-2"><i class="fas fa-minus"></i> {{ __('Delete') }}</button> 
                                <i class='fas fa-ellipsis-h mb-2 text-danger'></i>

                                <div class="action-box">
                                    <button class="btn actions mb-2"><i class="fas fa-clipboard-check mr-1"></i> {{ __('Show questionnaries') }}</button> 
                                    <button class="btn btn-orange mb-2"><i class="fas fa-user-plus"></i> {{ __('Assign students') }}</button> 
                                    <button class="btn actions btn-gray"><i class="fas fa-users mr-1"></i> {{ __('Show students') }}</button> 

                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

<!-- add new question modal -->
<div wire:ignore.self class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header py-3">
                <h3 class="modal-title">{{__('Add New Group')}}</h3>
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
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="name" class="form-label">{{__('Group Name')}} <sup class="text-danger">*</sup></label>
                                            <input wire:model="name" type="text" class="form-control"  :errors="$errors" autocomplete="off" />
                                            @error('name') <span class="error">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="level_id" class="form-label">{{__('Level')}} <sup class="text-danger">*</sup></label>
                                            <select wire:model="level_id" id="level_id" class="form-control" :errors="$errors">
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
                                <div class="row">
                                    <div class="col-12">
                                        <div class="table-responsive mt-4">
                                            <table class="table  users">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">{{ __('Name') }}</th>
                                                        <th scope="col">{{ __('Email') }}</th>
                                                        <th scope="col">{{ __('PIN') }}</th>
                                                        <th scope="col" class="text-center"><i class="fas fa-plus"></i> </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>Student name 1</td>
                                                        <td>some@email.com</td>
                                                        <td class="">675TY59i</td>
                                                        <td class="text-center ">
                                                            <i class="fas fa-minus"></i>  
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Student name 2</td>
                                                        <td>some@email.com</td>
                                                        <td class="">98IUY59i</td>
                                                        <td class="text-center">
                                                            <i class="fas fa-minus"></i>  
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Student name 3</td>
                                                        <td>some@email.com</td>
                                                        <td class="">675MNH59i</td>
                                                        <td class="text-center ">
                                                            <i class="fas fa-minus"></i>  
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Student name 4</td>
                                                        <td>some@email.com</td>
                                                        <td class="">67WSC59i</td>
                                                        <td class="text-center">
                                                            <i class="fas fa-minus"></i>  
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
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
                    <button type="button" wire:click.prevent="store" class="btn btn-orange btn-fix-size" >{{__('Save')}}</button>
                </div>
                <button type="button" wire:click.prevent="close" class="btn btn-white btn-fix-size" >{{__('Cancel')}}</button>
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