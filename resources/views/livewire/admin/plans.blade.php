<div>
<div class="content-wrapper">
    @if (session()->has('message'))
        <div class="alert alert-success" style="margin-top:30px;">
          {{ session('message') }}
        </div>
    @endif
    <div class="row">
        <div class="d-flex justify-content-end">
            <button class="bt badge badge-success mb-3" type="button" data-toggle="modal" data-target="#createModal"  wire:click="showForm">
                <i class="mdi mdi-plus-circle-outline mr-2"></i>
                {{ __('Add new plan') }}
            </button>
        </div>
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{ __('Plans') }}</h4>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>
                                        {{ __('Plan') }}
                                    </th>
                                    <th>
                                        {{ __('Actions') }}
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($plans->isNotEmpty()) 
                                    @foreach ($plans as $plan)
                                    <tr>
                                        <td class="py-1">
                                            {{ $plan->name }}
                                        </td>
                                        <td>
                                            <button class="bt badge badge-warning" data-toggle="modal" data-target="#editModal" wire:click="edit({{$plan->id}})"><i class=" mdi mdi-pencil-box-outline"></i> {{ __('Edit') }}</button>
                                            <button class="bt badge badge-danger" wire:click="delete({{ $plan->id }})"><i class=" mdi mdi-minus-circle-outline"></i> {{ __('Delete') }}</button>
                                        </td>
                                    </tr>
                                    @endforeach
                                @else
                  <tr>
                    <td colspan="4">
                      <div class="text-center text-muted mt-5 mb-5"><em>{{__('You don\'t have plans added yet')}}</em></div>
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
    <div class="row">
        <div class="col-12 text-center">
            {{ $plans->onEachSide(0)->links() }}
        </div>
    </div>   
</div>

<!-- add new land modal -->
<div wire:ignore.self class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg mw-800" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{{__('Create New Plan')}}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="inside-form">
                    
                    <div class="form-group">
                        <label for="name" class="form-label">{{__('Plan Name')}} <sup class="text-danger">*</sup></label>
                        <input wire:model="name" type="text" class="form-control"  :errors="$errors" autocomplete="off" />
                        @error('name') <span class="error">{{ $message }}</span> @enderror
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
                    <button type="button" wire:click="store" class="btn btn-primary" >{{__('Save Plan')}}</button>
                </div>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Cancel')}}</button>
            </div>
        </div>
    </div>
</div>
<!-- edit land modal -->
<div wire:ignore.self class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg mw-800" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{{__('Edit Plan')}}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="inside-form">
                    <input type="hidden" wire:model="plan_id">
                    <div class="form-group">
                        <label for="name" class="form-label">{{__('Plan Name')}} <sup class="text-danger">*</sup></label>
                        <input wire:model="name" type="text" class="form-control"  :errors="$errors" autocomplete="off" />
                        @error('name') <span class="error text-danger">{{ $message }}</span> @enderror
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
                <div wire:loading.remove wire:target="update">
                    <button type="button" wire:click="update" class="btn btn-primary" >{{__('Update Plan')}}</button>
                </div>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Cancel')}}</button>
            </div>
        </div>
    </div>
</div>
</div>


