<div>
    @if (session()->has('message'))
        <div class="alert alert-success" style="margin-top:30px;">
          {{ session('message') }}
        </div>
     @endif
    <div class="content-wrapper">
        <div class="content b-bottom pb-4">
            <div class="d-flex justify-content-between align-items-end mt-3 ">
               <div class="form-group mb-0">
                <label for="classroom_id" class="form-label">{{__('Course Group')}} <sup class="text-danger">*</sup></label>
                <select wire:model="classroom_id" wire:change="selectGroup($event.target.value)" id="classroom_id" class="form-control" :errors="$errors" style="min-width: 300px">
                    <option value="">{{__('Choose an option')}}</option>
                    @if(!empty($groups))
                        @foreach($groups as $option)
                            <option value="{{ $option->id }}">{{ $option->name }}</option>
                        @endforeach
                    @endif
                </select>
                @error('classroom_id') <span class="error">{{ $message }}</span> @enderror
            </div>
                <div>
                    <a href="{{ route('archive') }}" class="btn btn-orange btn-fix-size" >
                        <img src="/img/archive-white.png">
                        {{ __('View Archive') }}
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
                            <th scope="col">{{ __('Number of students') }}</th>
                            <th scope="col">{{ __('Start date') }}</th>
                            <th scope="col">{{ __('End date') }}</th>
                            <th scope="col" class="text-center">{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($courses && $courses->count() > 0)
                            @foreach($courses as $course) 
                                <tr>
                                    <td>{{$course->name}}</td>
                                    <td class="text-center">{{$classroom->users->count()}}</td>
                                    <td>{{date('d/m/Y g:i A', strtotime($course->start)) }}</td>
                                    <td>{{date('d/m/Y g:i A', strtotime($course->end)) }}</td>
                                    <td class="d-flex justify-content-center align-items-center">
                                        <div>
                                            <button class="btn actions mb-2" wire:click="show({{$course->id}}, {{ $classroom->id}})"><i class="fas fa-user-edit"></i> {{ __('View') }}</button>
                                            <button class="btn actions" wire:click="archive({{$course->id}}, {{ $classroom->id}})"><img src="/img/archive-orange.png" > {{ __('Archive') }}</button>
                                        </div> 
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="5">{{_('No results')}}</td>
                            </tr> 
                        @endif
                        
                    </tbody>
                </table>
            </div>
            <div class="pagin d-flex py-4 justify-content-end align-items-center">
               @if($courses && $courses->count() > 0) {{ $courses->links('custom-pagination-links-view') }}  @endif
            </div>
        </div>
    </div>

<!-- detail modal -->
<div wire:ignore.self class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header py-3">
                <h3 class="modal-title">{{__('Results Detail')}}</h3>
                <button type="button" class="close" wire:click="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body py-3">
                <div class="inside-form text-left">
                    <div class="table-responsive ">
                        <table class="table  ">
                            <thead>
                                <tr>
                                    <th scope="col">{{ __('Student') }}</th>
                                    <th scope="col">{{ __('Status') }}</th>
                                    <th scope="col">{{ __('Result') }}</th>
                                    <th scope="col" class="text-center">{{ __('Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($students && $students->count() > 0)
                                    @foreach($students as $student) 
                                        <tr>
                                            <td>{{$student->name}}</td>
                                            <td >{{$student->status}}</td>
                                            <td class="text-center">
                                                {{$student->result}}/{{$total}}
                                                <span class="d-block">{{$student->aproved}}</span>
                                            </td>
                                            <td class="d-flex justify-content-center align-items-center">
                                                    <button class="btn actions my-1" wire:click="print({{$course->id}}, {{ $classroom->id}})"><i class='fas fa-print mr-2'></i> {{ __('Certificade') }}</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="5">{{_('No results')}}</td>
                                    </tr> 
                                @endif  
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-end">
                <button type="button" wire:click.prevent="close" class="btn btn-orange btn-fix-size" >{{__('Cancel')}}</button>
            </div>
        </div>
    </div>
</div>

</div>

@push('scripts')
    <script>
        window.addEventListener('openModal', event => {         
            $('#detailModal').modal('show');
        });

        window.addEventListener('closeModal', event => {
            $('#detailModal').modal('hide');
        });

        
    </script>
@endpush


