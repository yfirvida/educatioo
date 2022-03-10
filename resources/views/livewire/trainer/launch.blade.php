<div>
    @if (session()->has('message'))
        <div class="alert alert-success" style="margin-top:30px;">
          {{ session('message') }}
        </div>
     @endif
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
                        <i class='fas fa-rocket mr-2'></i>
                        {{ __('Launch Course') }}
                    </a>
                </div> 
                
            </div>
        </div>
        <div class="content">
            <div class="table-responsive mt-4">
                <table class="table  ">
                    <thead>
                        <tr>
                            <th scope="col">{{ __('Name Quiz') }}</th>
                            <th scope="col">{{ __('Course Group') }}</th>
                            <th scope="col">{{ __('Number of students') }}</th>
                            <th scope="col">{{ __('Start date') }}</th>
                            <th scope="col">{{ __('End date') }}</th>
                            <th scope="col" class="text-center">{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($launchs->isNotEmpty())
                            @foreach ($launchs as $launch)
                                 @foreach ($launch->classrooms as $course)
                                    <tr>
                                        <td>{{$launch->name}}</td>
                                        <td class="text-wrap">{{$course->name}}</td>
                                        <td class="text-center">{{$course->users->count()}}</td>
                                        <td>{{date('d/m/Y g:i A', strtotime($course->pivot->start)) }}</td>
                                        <td>{{date('d/m/Y g:i A', strtotime($course->pivot->end))}}</td>
                                        <td class="d-flex justify-content-center align-items-center">
                                            <div>
                                                <button class="btn actions mb-2" wire:click="edit({{$course->id}}, {{ $launch->id}})"><i class="fas fa-edit"></i> {{ __('Edit') }}</button>
                                                <button class="btn actions mb-2" wire:click="confirm({{$course->id}}, {{ $launch->id}})"><i class="far fa-clock"></i> {{ __('End now') }}</button>
                                            </div> 
                                        </td>
                                    </tr>
                                @endforeach
                            @endforeach
                        @endif
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
                                <label for="classroom_id" class="form-label">{{__('Course Group')}} <sup class="text-danger">*</sup></label>
                                <select wire:model="classroom_id" wire:change="selectGroup($event.target.value)" id="classroom_id" class="form-control" :errors="$errors">
                                    <option value="">{{__('Choose an option')}}</option>
                                    @if(!empty($groups))
                                        @foreach($groups as $option)
                                            <option value="{{ $option->id }}">{{ $option->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @error('classroom_id') <span class="error">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="course_id" class="form-label">{{__('Course')}} <sup class="text-danger">*</sup></label>
                                <select wire:model="course_id" id="course_id" class="form-control" :errors="$errors">
                                    <option value="">{{__('Choose an option')}}</option>
                                    @if(!empty($quiz))
                                        @foreach($quiz as $option)
                                            <option value="{{ $option->id }}">{{ $option->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @error('course_id') <span class="error">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="form-group date datepickers" id="st_date" data-target-input="nearest" wire:ignore>
                                <label for="start" class="form-label">{{__('Start at')}}<sup class="text-danger">*</sup></label>
                                <input wire:model="start" id="start" name="start" type="text" value="" data-target="#st_date" data-toggle="datetimepicker" class="form-control col-md-6 datetimepicker-input" autocomplete="off" required>
                                <i class='far fa-calendar-alt'></i>
                            </div>
                            @error('start') <span class="error">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="form-group date datepickers" id="end_date" data-target-input="nearest">
                                <label for="end" class="form-label">{{__('Finish at')}}<sup class="text-danger">*</sup></label>
                                <input wire:model="end"  name="end" type="text" data-target="#end_date" data-toggle="datetimepicker" class="form-control col-md-6 datetimepicker-input" data-target="#end_date" autocomplete="off" required>
                                <i class='far fa-calendar-alt'></i>
                            </div>
                            @error('end') <span class="error">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="row flex-row">
                        <div class="col-lg-4 mb-3">
                            <div class="intro">
                                <div class="form-group mb-3">
                                    <label for="explanation" class="form-label">{{__('Instructions')}}<sup class="text-danger">*</sup> </label>
                                    <textarea  rows="6" wire:model="instructions" class="form-control"  :errors="$errors" ></textarea>
                                    @error('instructions') <span class="error">{{ $message }}</span> @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for="min_points" class="form-label">{{__('Passing Score')}} (%)<sup class="text-danger">*</sup></label>
                                    <input wire:model="min_points" class="form-control"  :errors="$errors" type="number"  class="form-control" autocomplete="off" required>
                                    @error('min_points') <span class="error">{{ $message }}</span> @enderror
                                </div>
                                <div class="form-group mb-0">
                                <label for="certificate_id" class="form-label">{{__('Certificate Design')}} <sup class="text-danger">*</sup></label>
                                <select wire:model="certificate_id" id="certificate_id" class="form-control" :errors="$errors">
                                    <option value="">{{__('Choose an option')}}</option>
                                    @if(!empty($certificates))
                                        @foreach($certificates as $option)
                                            <option value="{{ $option->id }}">{{ $option->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @error('certificate_id') <span class="error">{{ $message }}</span> @enderror
                            </div>
                            </div>
                        </div>
                        <div class="col-lg-8 mb-3">
                            <div class="table-responsive mt-4 users-wrapper">
                                <table class="table  users">
                                    <thead>
                                        <tr>
                                            <th scope="col">{{ __('Name') }}</th>
                                            <th scope="col">{{ __('Email') }}</th>
                                            <th scope="col">{{ __('PIN') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(!empty($students) && !$this->update_mode)
                                            @foreach($students as $index => $student)
                                                <tr wire:key="studentt-{{ $student->id }}">
                                                    <td>{{$student->name}}</td>
                                                    <td>{{$student->email}}</td>
                                                    <td class="">{{$student->pivot->pin}}</td>
                                                </tr>
                                            @endforeach
                                        @else 
                                            <tr>
                                                <td class="text-center" colspan="3">{{_('There are no students assigned to this group')}}</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>  
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" wire:click.prevent="close" class="btn btn-white btn-fix-size" >{{__('Cancel')}}</button>
                <div wire:loading wire:target="createModal">
                    <img src="{{ asset('star-admin/images/loading-gif.gif') }}" class="loader" />
                </div>
                <div wire:loading.remove wire:target="store">
                    <button type="button" wire:click.prevent="store" class="btn btn-orange btn-fix-size" >{{__('Send Invitation')}}</button>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- add edit launch modal -->
<div wire:ignore.self class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header py-3">
                <h3 class="modal-title">{{__('Edit Launch')}}</h3>
                <button type="button" class="close" wire:click="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body py-3">
                <div class="inside-form">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="classroom_id" class="form-label">{{__('Course Group')}} <sup class="text-danger">*</sup></label>
                                <select wire:model="classroom_id" wire:change="selectGroup($event.target.value)" id="classroom_id" class="form-control" :errors="$errors">
                                    <option value="">{{__('Choose an option')}}</option>
                                    @if(!empty($groups))
                                        @foreach($groups as $option)
                                            <option value="{{ $option->id }}">{{ $option->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @error('classroom_id') <span class="error">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="course_id" class="form-label">{{__('Course')}} <sup class="text-danger">*</sup></label>
                                <select wire:model="course_id" id="course_id" class="form-control" :errors="$errors">
                                    <option value="">{{__('Choose an option')}}</option>
                                    @if(!empty($quiz))
                                        @foreach($quiz as $option)
                                            <option value="{{ $option->id }}">{{ $option->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @error('course_id') <span class="error">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group date datepickers" id="start_date" data-target-input="nearest" wire:ignore>
                                <label for="start2" class="form-label">{{__('Start at')}}<sup class="text-danger">*</sup></label>
                                <input wire:model="start" id="start2" name="start" type="text" value="" data-target="#start_date" data-toggle="datetimepicker" class="form-control col-md-6 datetimepicker-input" autocomplete="off" required>
                                <i class='far fa-calendar-alt'></i>
                            </div>
                            @error('start') <span class="error">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group date datepickers" id="endd_date" data-target-input="nearest">
                                <label for="end2" class="form-label">{{__('Finish at')}}<sup class="text-danger">*</sup></label>
                                <input wire:model="end"  name="end2" type="text" data-target="#endd_date" data-toggle="datetimepicker" class="form-control col-md-6 datetimepicker-input" autocomplete="off" required>
                                <i class='far fa-calendar-alt'></i>
                            </div>
                            @error('end') <span class="error">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="row flex-row">
                        <div class="col-lg-6">
                            <div class="form-group mb-3">
                                <label for="min_points" class="form-label">{{__('Passing Score')}} (%)<sup class="text-danger">*</sup></label>
                                <input wire:model="min_points" class="form-control"  :errors="$errors" type="number"  class="form-control" autocomplete="off" required>
                                @error('min_points') <span class="error">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group ">
                                <label for="certificate_id" class="form-label">{{__('Certificate Design')}} <sup class="text-danger">*</sup></label>
                                <select wire:model="certificate_id" id="certificate_id" class="form-control" :errors="$errors">
                                    <option value="">{{__('Choose an option')}}</option>
                                    @if(!empty($certificates))
                                        @foreach($certificates as $option)
                                            <option value="{{ $option->id }}">{{ $option->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @error('certificate_id') <span class="error">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>  
                </div>
            </div>
            <div class="modal-footer">
                <div wire:loading wire:target="editModal">
                    <img src="{{ asset('star-admin/images/loading-gif.gif') }}" class="loader" />
                </div>
                <div wire:loading.remove wire:target="update">
                    <button type="button" wire:click.prevent="update" class="btn btn-orange btn-fix-size" >{{__('Save')}}</button>
                </div>
                <button type="button" wire:click.prevent="close" class="btn btn-white btn-fix-size" >{{__('Cancel')}}</button>
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
                    {{_('Are you sure you want end now this course?')}}
                </div>
            </div>
            <div class="modal-footer justify-content-center">
                <div wire:loading wire:target="end">
                    <img src="{{ asset('star-admin/images/loading-gif.gif') }}" class="loader" />
                </div>
                <div wire:loading.remove wire:target="end">
                    <button type="button" wire:click.prevent="endnow({{$current_course}}, {{$current_group}})" class="btn btn-orange btn-fix-size" >{{__('End now')}}</button>
                </div>
                <button type="button" wire:click.prevent="closeconfirm" class="btn btn-white btn-fix-size" >{{__('Cancel')}}</button>
            </div>
        </div>
    </div>
</div>

</div>

@push('scripts')
    <script>
        $(function() {
            $.fn.datetimepicker.Constructor.Default = $.extend({}, $.fn.datetimepicker.Constructor.Default, {
            format: 'DD/MM/YYYY LT',
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
            $('#st_date').datetimepicker({});
            $('#end_date').datetimepicker({});
            $('#start_date').datetimepicker({});
            $('#endd_date').datetimepicker({});
            
           $('#st_date').on("change.datetimepicker", function (e) {
                var date = $('#start').val(e.date.format('DD/MM/YYYY LT'));
                @this.set('start', $('#start').val());

            });
           $('#end_date').on("change.datetimepicker", function (e) {
                var date = $('#end_date').val(e.date.format('DD/MM/YYYY LT'));
                @this.set('end', $('#end_date').val());

            });

           $('#start_date').on("change.datetimepicker", function (e) {
                var date = $('#start2').val(e.date.format('DD/MM/YYYY LT'));
                @this.set('start', $('#start2').val());

            });
           $('#endd_date').on("change.datetimepicker", function (e) {
                var date = $('#endd_date').val(e.date.format('DD/MM/YYYY LT'));
                @this.set('end', $('#endd_date').val());

            });

        });
        window.addEventListener('openModal', event => {         
            $('#createModal').modal('show');
        });

        window.addEventListener('closeModal', event => {
            $('#createModal').modal('hide');
        });

         window.addEventListener('openEditModal', event => {         
            $('#editModal').modal('show');
        });

        window.addEventListener('closeEditModal', event => {
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
