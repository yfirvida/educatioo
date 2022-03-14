<div>
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
                                            <button class="btn actions mb-2"><i class="fas fa-user-edit"></i> {{ __('View') }}</button>
                                            <button class="btn actions"><img src="/img/archive-orange.png"> {{ __('Archive') }}</button>
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
        </div>
    </div>

