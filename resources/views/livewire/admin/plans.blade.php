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
                                        {{ __('Mail Message') }}
                                    </th>
                                    <th>
                                        {{ __('Upgrade Link') }}
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
                                        <td class="py-1">
                                            <?php echo nl2br($plan->intro); ?>
                                        </td>
                                        <td class="py-1">
                                            {{ $plan->link }}
                                        </td>
                                        <td>
                                            <button class="bt badge badge-warning" wire:click="edit({{$plan->id}})"><i class=" mdi mdi-pencil-box-outline"></i> {{ __('Edit') }}</button>
                                            <!-- <button class="bt badge badge-danger" wire:click="confirm({{ $plan->id }})"><i class=" mdi mdi-minus-circle-outline"></i> {{ __('Delete') }}</button> -->
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
    @if($plans->isNotEmpty()) 
    <div class="row">
        <div class="col-12 text-center">
            {{ $plans->onEachSide(0)->links() }}
        </div>
    </div> 
    @endif  
</div>

<!-- add new land modal -->
<div wire:ignore.self class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mt-0 modal-lg mw-800" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{{__('Create New Plan')}}</h4>
                <button type="button" class="close" wire:click="close" data-dismiss="modal" aria-label="Close">
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
                    <div class="form-group">
                        <label for="intro" class="form-label">{{__('Mail Message')}} <sup class="text-danger">*</sup></label>
                        <textarea wire:model="intro" class="form-control" rows="6"  :errors="$errors" autocomplete="off"></textarea>
                        @error('intro') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="link" class="form-label">{{__('Upgrade Link')}}</label>
                        <input wire:model="link" type="text" class="form-control"  :errors="$errors" autocomplete="off" />
                        @error('link') <span class="error">{{ $message }}</span> @enderror
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
                    <button type="button" wire:click.prevent="store" class="btn btn-primary" >{{__('Save Plan')}}</button>
                </div>
                <button type="button" class="btn btn-secondary" wire:click="close" data-dismiss="modal">{{__('Cancel')}}</button>
            </div>
        </div>
    </div>
</div>
<!-- edit land modal -->
<div wire:ignore.self class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mt-0 modal-lg mw-800" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{{__('Edit Plan')}}</h4>
                <button type="button" class="close" wire:click="close" data-dismiss="modal" aria-label="Close">
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
                    <div class="form-group">
                        <label for="intro" class="form-label">{{__('Mail Message')}} <sup class="text-danger">*</sup></label>
                        <textarea wire:model="intro" class="form-control" rows="6"  :errors="$errors" autocomplete="off"></textarea>
                        @error('intro') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="link" class="form-label">{{__('Upgrade Link')}}</label>
                        <input wire:model="link" type="text" class="form-control"  :errors="$errors" autocomplete="off" />
                        @error('link') <span class="error">{{ $message }}</span> @enderror
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
                    <button type="button" wire:click.prevent="update" class="btn btn-primary" >{{__('Update Plan')}}</button>
                </div>
                <button type="button" class="btn btn-secondary" wire:click="close" data-dismiss="modal">{{__('Cancel')}}</button>
            </div>
        </div>
    </div>
</div>

<!-- confirm modal -->
<div wire:ignore.self class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-body pb-3">
                <div class="inside-form text-center">
                    {{_('Are you sure you want delete this Plan?')}}
                </div>
            </div>
            <div class="modal-footer justify-content-center">
                <div wire:loading wire:target="end">
                    <img src="{{ asset('star-admin/images/loading-gif.gif') }}" class="loader" />
                </div>
                <div wire:loading.remove wire:target="end">
                    <button type="button" wire:click.prevent="delete({{ $current }})" class="btn btn-primary" >{{__('Delete')}}</button>
                </div>
                <button type="button" wire:click.prevent="closeconfirm" class="btn btn-secondary" >{{__('Cancel')}}</button>
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
        window.addEventListener('openUpdateModal', event => {           
            $('#editModal').modal('show');
        });

        window.addEventListener('closeUpdateModal', event => {
            $('#editModal').modal('hide');
        });
         window.addEventListener('openconfirmModal', event => {         
            $('#confirmModal').modal('show');
        });

        window.addEventListener('closeconfirmModal', event => {
            $('#confirmModal').modal('hide');
        });
    </script>
@endpush


