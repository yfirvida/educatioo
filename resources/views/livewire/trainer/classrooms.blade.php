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
                        @if($classrooms->isNotEmpty())
                            @foreach ($classrooms as $class)
                                <tr>
                                    <td>{{ $class->name }}</td>
                                    <td>{{ $class->level->level }}</td>
                                    <td class="text-center">{{$class->getCountUsers();}}</td>
                                    <td class="d-flex justify-content-between align-items-center act">
                                        <button wire:click="edit({{$class->id}})" class="btn actions mb-2 mr-2"><i class="fas fa-edit"></i> {{ __('Edit') }}</button>
                                        <button wire:click="delete({{$class->id}})" class="btn actions mb-2 mr-2"><i class="fas fa-minus"></i> {{ __('Delete') }}</button> 
                                        <i class='fas fa-ellipsis-h mb-2 text-danger'></i>

                                        <div class="action-box">
                                            <a class="btn actions mb-2" href="{{ route('courses-list', $class->id) }}"><i class="fas fa-clipboard-check mr-1"></i> {{ __('Show questionnaries') }}</a> 
                                            <button class="btn btn-orange mb-2" wire:click="showAssignForm({{$class->id}})"><i class="fas fa-user-plus"></i> {{ __('Assign students') }}</button> 

                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>

<!-- add new group modal -->
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
                                        <div class="table-responsive mt-4 users-wrapper">
                                            <table class="table  users">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">{{ __('Name') }}</th>
                                                        <th scope="col">{{ __('Email') }}</th>
                                                        <th scope="col">{{ __('PIN') }}</th>
                                                        <th scope="col" class="text-center"><a href="#" wire:click="showStForm"><i class="fas fa-plus"></i> </a></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if(!empty($students))
                                                        @foreach($students as $index => $student)
                                                            <tr wire:key="studentt-{{ $student->id }}">
                                                                <td>{{$student->name}}</td>
                                                                <td>{{$student->email}}</td>
                                                                <td class="">
                                                                    <input wire:model.defer="students.{{ $index }}.pin" type="text" class="form-control"  autocomplete="off" />
                                                                </td>
                                                                <td class="text-center ">
                                                                    <a href="#" wire:click="removeSt({{$index}})"><i class="fas fa-minus"></i></a> 
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    @else 
                                                        <tr>
                                                            <td class="text-center" colspan="4">{{_('There are no students assigned to this group')}}</td>
                                                        </tr>
                                                    @endif
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
                <div wire:loading wire:target="store">
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

<!-- edit group modal -->
<div wire:ignore.self class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header py-3">
                <h3 class="modal-title">{{__('Edit Course Group')}}</h3>
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
                                        <div class="table-responsive mt-4 users-wrapper">
                                            <table class="table  users">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">{{ __('Name') }}</th>
                                                        <th scope="col">{{ __('Email') }}</th>
                                                        <th scope="col">{{ __('PIN') }}</th>
                                                        <th scope="col" class="text-center"></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if(!empty($students))
                                                        @foreach($students as $index => $student)
                                                            <tr wire:key="student-{{ $student->id }}">
                                                                <td>{{$student->name}}</td>
                                                                <td>{{$student->email}}</td>
                                                                <td class="">
                                                                    <input wire:model.defer="students.{{ $index }}.pin" type="text" class="form-control"   autocomplete="off" />
                                                                </td>
                                                                <td class="text-center ">
                                                                    <a href="#" wire:click="removeFromClass({{$index}})"><i class="fas fa-minus"></i></a> 
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    @else 
                                                        <tr>
                                                            <td class="text-center" colspan="4">{{_('There are no students assigned to this group')}}</td>
                                                        </tr>
                                                    @endif
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
                <div wire:loading wire:target="update">
                    <img src="{{ asset('star-admin/images/loading-gif.gif') }}" class="loader" />
                </div>
                <div wire:loading.remove wire:target="update">
                    <button type="button" wire:click.prevent="update()" class="btn btn-orange btn-fix-size" >{{__('Save')}}</button>
                </div>
                <button type="button" wire:click.prevent="close" class="btn btn-white btn-fix-size" >{{__('Cancel')}}</button>
            </div>
        </div>
    </div>
</div>

<!-- assign students modal -->
<div wire:ignore.self class="modal fade" id="assignModal" tabindex="-1" role="dialog" aria-labelledby="assignModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header py-3">
                <h3 class="modal-title">{{__('Assign Students for')}} {{$name}} {{__('Course Group')}}</h3>
                <button type="button" class="close" wire:click="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body pt-3">
                <div class="inside-form">
                    <div class="row">
                        <div class="col-12">
                            <div class="question-wrapper">
                                <div class="row mb-2">
                                    <div class="col-sm-6 col-md-8 pr-sm-1">
                                        <div class="form-group mb-2">
                                            <select wire:model="st_id" id="st_id" class="form-control" :errors="$errors">
                                                <option value="">{{__('Students')}}</option>
                                                @if(!empty($extras))
                                                    @foreach($extras as $option)
                                                        <option value="{{ $option->id }}">{{$option->name}} ({{$option->email}})</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            @error('st_id') <span class="error">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 pl-sm-0">
                                        <div wire:loading wire:target="assign">
                                            <img src="{{ asset('star-admin/images/loading-gif.gif') }}" class="loader" />
                                        </div>
                                        <div wire:loading.remove wire:target="assign">
                                            <button type="button" wire:click.prevent="assign()" class="btn btn-orange w-100" style="min-height: 2rem">{{__('Add to Group')}}</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="table-responsive users-wrapper">
                                            <table class="table  users">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">{{ __('Name') }}</th>
                                                        <th scope="col">{{ __('Email') }}</th>
                                                        <th scope="col">{{ __('PIN') }}</th>
                                                        <th scope="col" class="text-center"><a href="#" wire:click="showStForm"><i class="fas fa-plus"></i> </a></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if(!empty($assignST))
                                                        @foreach($assignST as $index => $student)
                                                            <tr wire:key="assignST-{{ $student->id }}">
                                                                <td>{{$student->name}}</td>
                                                                <td>{{$student->email}}</td>
                                                                <td class="">
                                                                    <input wire:model.defer="assignST.{{ $index }}.pin" type="text" class="form-control"  autocomplete="off" />
                                                                </td>
                                                                <td class="text-center ">
                                                                    <a href="#" wire:click="removeASt({{$index}}, {{$student->id}})"><i class="fas fa-minus"></i></a> 
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    @else 
                                                        <tr>
                                                            <td class="text-center" colspan="4">{{_('There are no students assigned to this group')}}</td>
                                                        </tr>
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" wire:click.prevent="close" class="btn btn-white btn-fix-size" >{{__('Cancel')}}</button>
            </div>
        </div>
    </div>
</div>
<!-- add new student modal -->
<div wire:ignore.self class="modal fade" id="createStModal" tabindex="-1" role="dialog" aria-labelledby="createStModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header py-3">
                <h3 class="modal-title">{{__('Add New Student')}}</h3>
                <button type="button" class="close" wire:click="closeStd" data-dismiss="modal" aria-label="Close">
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
                                            <label for="namestd" class="form-label">{{__('Name')}} <sup class="text-danger">*</sup></label>
                                            <input wire:model="namestd" type="text" class="form-control"  :errors="$errors" autocomplete="off" />
                                            @error('namestd') <span class="error">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="email" class="form-label">{{__('Email')}} <sup class="text-danger">*</sup></label>
                                            <input wire:model="email" type="text" class="form-control"  :errors="$errors" autocomplete="off" />
                                            @error('email') <span class="error">{{ $message }}</span> @enderror
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
                <div wire:loading wire:target="storeStudent">
                    <img src="{{ asset('star-admin/images/loading-gif.gif') }}" class="loader" />
                </div>
                <div wire:loading.remove wire:target="storeStudent">
                    <button type="button" wire:click.prevent="storeStudent" class="btn btn-orange btn-fix-size" >{{__('Save')}}</button>
                </div>
                <button type="button" wire:click.prevent="closeStd" class="btn btn-white btn-fix-size" >{{__('Cancel')}}</button>
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
            $('#updateModal').modal('show');
        });

        window.addEventListener('closeUpdateModal', event => {
            $('#updateModal').modal('hide');
        });
        
        window.addEventListener('openAssignModal', event => {         
            $('#assignModal').modal('show');
        });

        window.addEventListener('closeAssignModal', event => {
            $('#assignModal').modal('hide');
        });

        window.addEventListener('openStdModal', event => {         
            $('#createStModal').modal('show');
        });

        window.addEventListener('closeStdModal', event => {
            $('#createStModal').modal('hide');
        });
    </script>
@endpush