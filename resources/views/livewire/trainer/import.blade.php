<div>
    @if (session()->has('message'))
        <div class="alert alert-success" style="margin-top:30px;">
          {{ session('message') }}
        </div>
     @endif
    <div class="content-wrapper">
        <div class="content ">
            <h2 class="mb-3">{{ __('Import Course') }}</h2>
            <form class="import-form">
                <div class="inside-form">
                    <div class="form-group">
                        <label for="url" class="form-label mt-3">{{__('Import File URL')}} <sup class="text-danger">*</sup></label>
                        <div class="input-group">
                            <input wire:model="url" type="text" class="form-control btn-fix-size"  :errors="$errors" autocomplete="off" />
                                @error('url') <span class="error">{{ $message }}</span> @enderror
                            <div class="input-group-append">
                                <button class="btn btn-orange btn-fix-size"> <i class="fas fa-cloud-upload-alt"></i> {{__('Cancel')}}</button>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="form-label">{{__('Onder welke naam wil je deze course opslaan?')}} <sup class="text-danger">*</sup></sup></label>
                        <input wire:model="name" type="text" class="form-control btn-fix-size"  :errors="$errors" autocomplete="off" />
                        @error('name') <span class="error">{{ $message }}</span> @enderror
                    </div>
                </div> 
                <div class="inside-form mt-1 pb-0">
                    <small class="text-danger"><em><sup >*</sup> <apan class="text-muted">{{__('Required fields')}}</apan></em></small>
                </div>
                <button type="button" class="btn btn-orange btn-fix-size mt-4" wire:click="import()"><i class="fas fa-file-import"></i> {{__('Import')}}</button> 
            </form> 
        </div>
    </div>
</div>

