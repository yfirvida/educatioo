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
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

<!-- add new launch modal -->
<div wire:ignore.self class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header py-3">
                <h3 class="modal-title">{{__('Launch Course')}}</h3>
                <button type="button" class="close" wire:click="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body py-3">
                <div class="inside-form">
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="level_id" class="form-label">{{__('Course Group')}} <sup class="text-danger">*</sup></label>
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
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="level_id" class="form-label">{{__('Course')}} <sup class="text-danger">*</sup></label>
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
                        <div class="col-lg-3 col-md-6">
                            <div class="form-group date datepickers" id="st_date" data-target-input="nearest">
                                <label for="end" class="form-label">{{__('Finish at')}}<sup class="text-danger">*</sup></label>
                                <input wire:model="start" id="start" name="start" type="text" data-target="#st_date" data-toggle="datetimepicker" class="form-control col-md-6 datetimepicker-input" data-target="#st_date" autocomplete="off" required>
                                <i class='far fa-calendar-alt'></i>
                            </div>
                            @error('start') <span class="error">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="form-group date datepickers" id="end_date" data-target-input="nearest">
                                <label for="end" class="form-label">{{__('Finish at')}}<sup class="text-danger">*</sup></label>
                                <input wire:model="end" id="end" name="end" type="text" data-target="#end_date" data-toggle="datetimepicker" class="form-control col-md-6 datetimepicker-input" data-target="#end_date" autocomplete="off" required>
                                <i class='far fa-calendar-alt'></i>
                            </div>
                            @error('end') <span class="error">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="row flex-row">
                        <div class="col-lg-4 mb-3">
                            <div class="intro">
                                <div class="form-group mb-3">
                                    <label for="explanation" class="form-label">{{__('Instructions')}} </label>
                                    <textarea  rows="6" wire:model="instructions" class="form-control"  :errors="$errors" ></textarea>
                                    @error('instructions') <span class="error">{{ $message }}</span> @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for="min_points" class="form-label">{{__('Passing Score')}} (%)</label>
                                    <input wire:model="min_points" class="form-control"  :errors="$errors" type="number"  class="form-control" autocomplete="off" required>
                                    @error('min_points') <span class="error">{{ $message }}</span> @enderror
                                </div>
                                <div class="form-group mb-0">
                                <label for="certificate_id" class="form-label">{{__('Certificate Design')}} <sup class="text-danger">*</sup></label>
                                <select wire:model="certificate_id" id="certificate_id" class="form-control" :errors="$errors">
                                    <option value="">{{__('Choose an option')}}</option>
                                    @if(!empty($certificates))
                                        @foreach($certificates as $option)
                                            <option value="{{ $option->id }}">{{ $option->level }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @error('certificate_id') <span class="error">{{ $message }}</span> @enderror
                            </div>
                            </div>
                        </div>
                        <div class="col-lg-8 mb-3">
                            <div class="table-responsive fix-table">
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
        $(function() {
            $.fn.datetimepicker.Constructor.Default = $.extend({}, $.fn.datetimepicker.Constructor.Default, {
            icons: {
                time: 'far fa-clock',
                date: 'far fa-calendar',
                up: 'fas fa-chevron-up',
                down: 'fas fa-chevron-down',
                previous: 'fas fa-chevron-left',
                next: 'fas fa-chevron-right',
                today: 'far fa-calendar-check',
                clear: 'far fa-trash-alt',
                close: 'far fa-times'
            } });
            $('.datepickers').datetimepicker({});
        });
        window.addEventListener('openModal', event => {         
            $('#createModal').modal('show');
        });

        window.addEventListener('closeModal', event => {
            $('#createModal').modal('hide');
        });
        
    </script>
@endpush
