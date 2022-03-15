<div>
<div class="content-wrapper">
    @if (session()->has('message'))
        <div class="alert alert-success" style="margin-top:30px;">
          {{ session('message') }}
        </div>
    @endif
    <div class="row">
        <div class="d-flex justify-content-end">
            <button class="bt badge badge-warning mb-3" type="button" wire:click="edit({{$user->id}})">
                <i class=" mdi mdi-pencil-box-outline"></i> {{ __('Edit') }}
            </button>
            <button class="bt badge badge-warning mb-3" type="button" wire:click="editpass({{$user->id}})">
                <i class=" mdi mdi-pencil-box-outline"></i> {{ __('Change Password') }}
            </button>
        </div>
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{ __('Profile') }}</h4>
                    <div class="row">
                        <div class="col-md-4 profile-wrapper image-upload">
                            <figure class="profile-pic">
                                @if($image)
                                    @if (!$uploaded)
                                        <img src="{{$image}}"  alt="{{__('Profile image')}}" />
                                    @else
                                        <img src="<?php echo Theme::url('uploads'); ?>/{{$profile_image}}"  alt="{{__('Profile image')}}" />
                                        <i class="fas fa-pencil-alt profile"></i>
                                    @endif
                                @else
                                    @if ($profile_image)
                                        <img src="<?php echo Theme::url('uploads'); ?>/{{$profile_image}}"  alt="{{__('Profile image')}}" />
                                        <i class="fas fa-pencil-alt profile"></i>
                                    @else
                                        <img src="{{asset('/star-admin/images/faces/face21.jpg')}}"   alt="{{__('Profile image')}}">
                                        <i class="fas fa-pencil-alt profile"></i>
                                    @endif
                                @endif
                            </figure>
                            <input type="file" id="file" name="profile_image" wire:model="profile_image" wire:change="$emit('fileChoosen')" :errors="$errors"  style="display:none"/>
                            @if($image)
                                @if (!$uploaded)
                                    <div class="row text-center">
                                    <span class="mt-2" >
                                        <a class="blue" wire:click="uploadImage">{{__('Save your new profile image!')}}</a>
                                    </span>
                                    </div>
                                @endif
                            @endif

                            @error('profile_image') <span class="error">{{ $message }}</span> @enderror

                            @if (session()->has('successImage'))
                                <div class="alert alert-success" style="margin-top:30px;">
                                  {{ session('successImage') }}
                                </div>
                            @endif
                        </div>
                        <div class="col-md-8">
                            <table class="table">
                                <tr>
                                    <td><strong>{{ __('Name') }}</strong></td>
                                    <td>{{$user->name}}</td>
                                </tr>
                                <tr>
                                    <td><strong>{{ __('Email') }}</strong></td>
                                    <td>{{$user->email}}</td>
                                </tr>
                                <tr>
                                    <td><strong>{{ __('Password') }}</strong></td>
                                    <td>********</td>
                                </tr>
                                <tr>
                                    <td><strong>{{ __('Country') }}</strong></td>
                                    <td class="lowercase">{{$user->land->name}}</td>
                                </tr>
                                <tr>
                                    <td><strong>{{ __('Role') }}</strong></td>
                                    <td>{{$user->role}}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
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
                        </div>
                        <div class="col-md-6">
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
<!-- edit password modal -->
<div wire:ignore.self class="modal fade" id="passModal" tabindex="-1" role="dialog" aria-labelledby="passModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg mw-800" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{{__('Change Password')}}</h4>
                <button type="button" class="close" wire:click="close" data-dismiss="modal">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="inside-form">
                    <input type="hidden" wire:model="role">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="password" class="form-label">{{__('Password')}} <sup class="text-danger">*</sup></label>
                                <input wire:model="password" type="password" class="form-control"  :errors="$errors" autocomplete="off" />
                                @error('password') <span class="error">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                    <div class="inside-form mt-1 pb-0">
                        <small class="text-danger"><em><sup >*</sup> <apan class="text-muted">{{__('Required fields')}}</apan></em></small>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div wire:loading wire:target="passModal">
                    <img src="{{ asset('star-admin/images/loading-gif.gif') }}" class="loader" />
                </div>
                <div wire:loading.remove wire:target="update">
                    <button type="button" wire:click="updatepass" data-dismiss="modal" class="btn btn-primary" >{{__('Change Password')}}</button>
                </div>
                <button type="button" class="btn btn-secondary" wire:click="close" data-dismiss="modal">{{__('Cancel')}}</button>
            </div>
        </div>
    </div>
</div>

</div>
@push('scripts')
    <script>
        window.addEventListener('openUpdateModal', event => {           
            $('#editModal').modal('show');
        });
        window.addEventListener('closeUpdateModal', event => {
            $('#editModal').modal('hide');
        });
         window.addEventListener('openPassModal', event => {           
            $('#passModal').modal('show');
        });
        window.addEventListener('closePassModal', event => {
            $('#passModal').modal('hide');
        });

        document.addEventListener('livewire:load', function () {
            $(".profile-wrapper").on( "click", ".fa-pencil-alt.profile", function() {
                $('input#file').trigger('click');
            });

            window.livewire.on('fileChoosen', () => {

            let inputField = document.getElementById('file');

            let file = inputField.files[0];

            let reader = new FileReader();

            reader.onloadend = () => {

                window.livewire.emit('fileUpload', reader.result);
            }

            reader.readAsDataURL(file);

            });
        });

        
    </script>
@endpush



