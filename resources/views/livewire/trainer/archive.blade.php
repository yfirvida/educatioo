<div>
    <div class="content-wrapper">
        <div class="content b-bottom pb-4">
            <h2 class="mb-3">{{ __('Courses Archive') }}</h2>
            <div class="d-flex justify-content-end align-items-center mt-3 ">
                <a href="{{ route('newcourse') }}" class="btn btn-orange btn-fix-size" >
                    <img src="/img/quiz.png">
                    {{ __('Add new course') }}
                </a>
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
                        </tr>
                    </thead>
                    <tbody>
                        @if($courses && $courses->count() > 0)
                            @foreach($courses as $course) 
                                @foreach ($course->classrooms as $class)
                                 @if($class->pivot->archive == 1)
                                    <tr>
                                        <td>{{$course->name}}</td>
                                        <td class="text-wrap">{{$class->name}}</td>
                                        <td class="text-center">{{$class->users->count()}}</td>
                                        <td>{{date('d/m/Y g:i A', strtotime($class->pivot->start)) }}</td>
                                        <td>{{date('d/m/Y g:i A', strtotime($class->pivot->end)) }}</td>
                                    </tr>
                                    @endif
                                @endforeach
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
              {{ $courses->links() }}  
            </div>
        </div>
    </div>


