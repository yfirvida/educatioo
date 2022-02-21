<div>
<div class="content-wrapper">
    @if (session()->has('message'))
        <div class="alert alert-success" style="margin-top:30px;">
          {{ session('message') }}
        </div>
    @endif
    <div class="row">
        <div class="d-flex justify-content-end">
            <button class="bt badge badge-success mb-3" type="button"  wire:click="showForm">
                <i class="mdi mdi-account-plus mr-2"></i>
                {{ __('Add new trainer') }}
            </button>
        </div>
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{ __('Trainers') }}</h4>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>
                                        {{ __('Name') }}
                                    </th>
                                    <th>
                                        {{ __('Email') }}
                                    </th>
                                    <th>
                                        {{ __('Land') }}
                                    </th>
                                    <th>
                                        {{ __('Students') }}
                                    </th>
                                     <th>
                                        {{ __('Quiz') }}
                                    </th>
                                    <th>
                                        {{ __('Last Session') }}
                                    </th>
                                    <th>
                                        {{ __('Subscription') }}
                                    </th>
                                    <th>
                                        {{ __('Actions') }}
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($trainers->isNotEmpty()) 
                                    @foreach ($trainers as $user)
                                    <tr>
                                        <td class="py-1">
                                            {{ $user->name }}
                                        </td>
                                        <td>
                                            {{ $user->email }}
                                        </td>
                                        <td class="lowercase">
                                            {{ $user->land->name }}
                                        </td>
                                        <td>
                                            {{ $user->total_students }}
                                        </td>
                                        <td>
                                            {{ $total_quiz }}
                                        </td>
                                        <td>
                                            {{ $user->last_session }}
                                        </td>
                                        <td>
                                            @if($user->subscription_date != null) 
                                                {{ $user->subscription_date }}
                                            @else
                                                <span class="text-danger">{{ __('Canceled') }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <button class="bt badge badge-warning "  wire:click="edit({{$user->id}})"><i class=" mdi mdi-pencil-box-outline"></i> {{ __('Edit') }}</button>
                                            <button class="bt badge badge-danger" wire:click="delete({{ $user->id }})"><i class=" mdi mdi-minus-circle-outline" ></i> {{ __('Delete') }}</button>
                                            <button class="bt badge badge-danger" wire:click="cancelsubscription({{ $user->id }})"><i class=" mdi mdi-minus-circle-outline" ></i> {{ __('Cancel') }}</button>
                                        </td>
                                    </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="9">
                                            <div class="text-center text-muted mt-5 mb-5"><em>{{__('You don\'t have trainers added yet')}}</em></div>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if($trainers->isNotEmpty())
    <div class="row">
        <div class="col-12 text-center">
            {{ $trainers->onEachSide(0)->links() }}
        </div>
    </div>
    @endif    
</div>

<!-- add new user modal -->
<div wire:ignore.self class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg mw-800" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{{__('Create New Trainer')}}</h4>
                <button type="button" class="close" wire:click="close" data-dismiss="modal">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="inside-form">
                    <input type="hidden" wire:model="role">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name" class="form-label">{{__('Trainer Name')}} <sup class="text-danger">*</sup></label>
                                <input wire:model="name" type="text" class="form-control"  :errors="$errors" autocomplete="off" />
                                @error('name') <span class="error">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group">
                                <label for="email" class="form-label">{{__('Email')}} <sup class="text-danger">*</sup></label>
                                <input wire:model="email" type="email" class="form-control"  :errors="$errors" autocomplete="off" />
                                @error('email') <span class="error">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group">
                                <label for="password" class="form-label">{{__('Password')}} <sup class="text-danger">*</sup></label>
                                <input wire:model="password" type="password" class="form-control"  :errors="$errors" autocomplete="off" />
                                @error('password') <span class="error">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="school" class="form-label">{{__('School')}}</label>
                                <input wire:model="school" type="text" class="form-control"  :errors="$errors" autocomplete="off" />
                                @error('school') <span class="error">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group">
                                <label for="land_id" class="form-label">{{__('Country')}} <sup class="text-danger">*</sup></label>
                                <select wire:model="land_id" id="land_id" class="form-control" :errors="$errors">
                                    <option value="">{{__('Choose an option')}}</option>
                                    @if(!empty($lands))
                                        @foreach($lands as $option)
                                            <option value="{{ $option->id }}">{{ $option->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @error('land_id') <span class="error">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group">
                                <label for="subscription_date" class="form-label">{{__('Subscription Date')}} (yyyy/mm/dd)<sup class="text-danger">*</sup></label>
                                <div class="input-group date">
                                    <input wire:model="subscription_date" id="subscription_date" type="text" class="form-control"  :errors="$errors" autocomplete="off" />
                                    <span class="input-group-addon">
                                        <span class="mdi mdi mdi-calendar-text"></span>
                                    </span>
                                </div>
                                @error('subscription_date') <span class="error">{{ $message }}</span> @enderror
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
                    <button type="button" wire:click="store" data-dismiss="modal" class="btn btn-primary" >{{__('Save Trainer')}}</button>
                </div>
                <button type="button" class="btn btn-secondary" wire:click="close" data-dismiss="modal">{{__('Cancel')}}</button>
            </div>
        </div>
    </div>
</div>

<!-- edit user modal -->
<div wire:ignore.self class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg mw-800" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{{__('Edit Trainer')}}</h4>
                <button type="button" class="close" wire:click="close" data-dismiss="modal">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="inside-form">
                    <input type="hidden" wire:model="role">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name" class="form-label">{{__('Trainer Name')}} <sup class="text-danger">*</sup></label>
                                <input wire:model="name" type="text" class="form-control"  :errors="$errors" autocomplete="off" />
                                @error('name') <span class="error">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group">
                                <label for="email" class="form-label">{{__('Email')}} <sup class="text-danger">*</sup></label>
                                <input wire:model="email" type="email" class="form-control"  :errors="$errors" autocomplete="off" />
                                @error('email') <span class="error">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group">
                                <label for="password" class="form-label">{{__('Password')}} <sup class="text-danger">*</sup></label>
                                <input wire:model="password" type="password" class="form-control"  :errors="$errors" autocomplete="off" />
                                @error('password') <span class="error">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="school" class="form-label">{{__('School')}}</label>
                                <input wire:model="school" type="text" class="form-control"  :errors="$errors" autocomplete="off" />
                                @error('school') <span class="error">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group">
                                <label for="land_id" class="form-label">{{__('Country')}} <sup class="text-danger">*</sup></label>
                                <select wire:model="land_id" id="land_id" class="form-control" :errors="$errors">
                                    <option value="">{{__('Choose an option')}}</option>
                                    @if(!empty($lands))
                                        @foreach($lands as $option)
                                            <option value="{{ $option->id }}">{{ $option->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @error('land_id') <span class="error">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group">
                                <label for="subscription_date2" class="form-label">{{__('Subscription Date')}} (yyyy/mm/dd)<sup class="text-danger">*</sup></label>
                                <div class="input-group date">
                                    <input wire:model="subscription_date" id="subscription_date2" type="text" class="form-control"  :errors="$errors" autocomplete="off" />
                                    <span class="input-group-addon">
                                        <span class="mdi mdi mdi-calendar-text"></span>
                                    </span>
                                </div>
                                @error('subscription_date') <span class="error">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                    <div class="inside-form mt-1 pb-0">
                        <small class="text-danger"><em><sup >*</sup> <apan class="text-muted">{{__('Required fields')}}</apan></em></small>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div wire:loading wire:target="updateModal">
                    <img src="{{ asset('star-admin/images/loading-gif.gif') }}" class="loader" />
                </div>
                <div wire:loading.remove wire:target="update">
                    <button type="button" wire:click="update" data-dismiss="modal" class="btn btn-primary" >{{__('Update Trainer')}}</button>
                </div>
                <button type="button" class="btn btn-secondary" wire:click="close" data-dismiss="modal">{{__('Cancel')}}</button>
            </div>
        </div>
    </div>
</div>

</div>
@push('scripts')
    <script>
        $('#subscription_date').datepicker({
                format: "yyyy-mm-dd",
                autoclose: true,
                todayHighlight: true,
            }).on('change', function(e){
                @this.set('subscription_date', e.target.value);
            });
        $('#subscription_date2').datepicker({
                format: "yyyy-mm-dd",
                autoclose: true,
                todayHighlight: true,
            }).on('change', function(e){
                @this.set('subscription_date', e.target.value);
            });
        window.addEventListener('openModal', event => {  
            console.log('enter');       
            $('#createModal').modal('show');
        });

        window.addEventListener('closeModal', event => {
            console.log('hide');  
            $('#createModal').modal('hide');
        });
        window.addEventListener('openUpdateModal', event => {           
            $('#editModal').modal('show');
        });
        window.addEventListener('closeUpdateModal', event => {
            $('#editModal').modal('hide');
        });
    </script>
@endpush

