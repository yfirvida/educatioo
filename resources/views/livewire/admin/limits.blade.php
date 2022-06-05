<div>
    <div class="content-wrapper">
    @if (session()->has('message'))
        <div class="alert alert-success" style="margin-top:30px;">
          {{ session('message') }}
        </div>
    @endif
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{ __('Basic') }}</h4>
                    <div class="table-responsive">
                        <table class="table ">
                            <thead>
                                <tr>
                                    <th>
                                        {{ __('Groups Limit') }}
                                    </th>
                                    <th>
                                        {{ __('Courses Limit') }}
                                    </th>
                                    <th>
                                        {{ __('Students per Group') }}
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="">
                                       <input wire:model="gLimit" type="number" step="5" class="form-control"  :errors="$errors" autocomplete="off" />
                                        @error('gLimit') <span class="error">{{ $message }}</span> @enderror 
                                    </td>
                                    <td class="">
                                       <input wire:model="cLimit" type="number" step="5" class="form-control"  :errors="$errors" autocomplete="off" />
                                        @error('cLimit') <span class="error">{{ $message }}</span> @enderror 
                                    </td>
                                    <td class="">
                                      <input wire:model="sLimit" type="number" step="5" class="form-control"  :errors="$errors" autocomplete="off" />
                                        @error('sLimit') <span class="error">{{ $message }}</span> @enderror  
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-end align-items-center mt-3">
                            <div wire:loading wire:target="storeBasic">
                                <img src="{{ asset('star-admin/images/loading-gif.gif') }}" class="loader" />
                            </div>
                            <div wire:loading.remove wire:target="storeBasic">
                                <button type="button" wire:click.prevent="storeBasic" class="btn btn-primary" >{{__('Save')}}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{ __('Premium') }}</h4>
                    <div class="table-responsive">
                        <table class="table ">
                            <thead>
                                <tr>
                                    <th>
                                        {{ __('Groups Limit') }}
                                    </th>
                                    <th>
                                        {{ __('Courses Limit') }}
                                    </th>
                                    <th>
                                        {{ __('Students per Group') }}
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <tr>
                                    <td class="">
                                       <input wire:model="pgLimit" type="number" step="5" class="form-control"  :errors="$errors" autocomplete="off" disabled/>
                                        @error('pgLimit') <span class="error">{{ $message }}</span> @enderror 
                                    </td>
                                    <td class="">
                                       <input wire:model="pcLimit" type="number" step="5" class="form-control"  :errors="$errors" autocomplete="off" disabled/>
                                        @error('pcLimit') <span class="error">{{ $message }}</span> @enderror 
                                    </td>
                                    <td class="">
                                      <input wire:model="psLimit" type="number" step="5" class="form-control"  :errors="$errors" autocomplete="off" />
                                        @error('psLimit') <span class="error">{{ $message }}</span> @enderror  
                                    </td>
                                </tr>
                                </tr>
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-end align-items-center mt-3">
                            <div wire:loading wire:target="storePremium">
                                <img src="{{ asset('star-admin/images/loading-gif.gif') }}" class="loader" />
                            </div>
                            <div wire:loading.remove wire:target="storePremium">
                                <button type="button" wire:click.prevent="storePremium" class="btn btn-primary " >{{__('Save')}}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


</div>
