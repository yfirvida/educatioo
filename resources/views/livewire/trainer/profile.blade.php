<div>
    @if (session()->has('message'))
        <div class="alert alert-success" style="margin-top:30px;">
          {{ session('message') }}
        </div>
     @endif
    <div class="content-wrapper">
        <div class="content b-bottom pb-4">
            <div class="d-flex justify-content-start align-items-center mt-3 ">
                <h2>{{_('Profile')}}</h2>  
            </div>
        </div>
        <div class="content px-5">
            <div class="img-wrapper">
            <div class="w-100 d-flex justify-center mt-3">
                 @if($profile_image)
                    @if (!$uploaded)
                        <img id="profilePrev" class="profile-pic" src="{{$profile_image->temporaryUrl()}}"  alt="{{__('Profile image')}}" />
                    @else
                        <img id="profilePrev" class="profile-pic" src="<?php echo Theme::url('uploads'); ?>/{{$image}}"  alt="{{__('Profile image')}}" />
                    @endif
                @else
                    @if ($image)
                        <img id="profilePrev" class="profile-pic" src="<?php echo Theme::url('uploads'); ?>/{{$image}}"  alt="{{__('Profile image')}}" />
                    @else
                        <img id="profilePrev" class="profile-pic" src="/img/profile-image.png"   alt="{{__('Profile image')}}">
                    @endif
                @endif
            </div>
            <div class="text-center mb-2"><span class="upload-link">{{ __('Upload photo') }} </span></div>
            <input type="file" id="fileP" wire:model="profile_image" name="profile_image" style="display:none" accept="image/*"/>
            </div>
            <div class="row mt-4">
                <div class="col-md-6">
                 <!-- Name -->
                <div class="form-group">
                    <label for="name" class="form-label">{{__('Name')}} <sup class="text-danger">*</sup></label>
                    <input wire:model="name" type="text" class="form-control"  :errors="$errors" autocomplete="off" />
                    @error('name') <span class="error">{{ $message }}</span> @enderror
                </div>
                <!-- Password -->
                <div class="mt-3">
                    <div class="form-group">
                        <label for="password" class="form-label">{{__('Password')}} <sup class="text-danger">*</sup></label>
                        <input wire:model="password" type="password" class="form-control"  :errors="$errors" autocomplete="off" />
                        @error('password') <span class="error">{{ $message }}</span> @enderror
                    </div>
                </div>
                <!-- Role -->
                <div class="mt-3">
                    <div class="form-group">
                        <label for="role" class="form-label">{{__('Role')}} <sup class="text-danger">*</sup></label>
                        <input type="text" class="form-control"  value="Trainer" :errors="$errors" autocomplete="off" disabled/>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <!-- Email Address -->
                <div class="form-group">
                    <label for="email" class="form-label">{{__('Email')}} <sup class="text-danger">*</sup></label>
                    <input wire:model="email" type="email" class="form-control"  :errors="$errors" autocomplete="off" />
                    @error('email') <span class="error">{{ $message }}</span> @enderror
                </div>
                <!-- School -->
                <div class="form-group">
                    <label for="school" class="form-label">{{__('Company School')}}</label>
                    <input wire:model="school" type="text" class="form-control"  :errors="$errors" autocomplete="off" />
                    @error('school') <span class="error">{{ $message }}</span> @enderror
                </div>
                <!-- Land -->
                <div class="mt-3">
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
        </div>

        <div class="flex items-center justify-center">
            <button type="button" wire:click.prevent="update" class="btn btn-orange btn-fix-size my-4" >{{__('Update')}}</button>
        </div>
    </div>
</div>
</div>
@push('scripts')
    <script>
        document.addEventListener('livewire:load', function () {
            $(".img-wrapper").on( "click", ".upload-link", function() {
                $("#fileP").trigger('click');
            });
        });
    </script>
@endpush



