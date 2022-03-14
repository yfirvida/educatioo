<div>
    <div class="content-wrapper">
        <div class="content b-bottom pb-4">
            <div class="d-flex justify-content-between align-items-center mt-3 ">
                <h2 class="mb-3">{{ __('Course Group') }} {{$class->name}}</h2>
                <div>
                    <a href="{{ route('import') }}" class="btn mr-3 btn-white btn-fix-size">   
                        <i class="fas fa-file-import"></i> {{ __('Import') }}
                    </a>
                    <a href="{{ route('newcourse') }}" class="btn btn-orange btn-fix-size" >
                        <img src="/img/quiz.png">
                        {{ __('Add new course') }}
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
                            <th scope="col">{{ __('Level') }}</th>
                            <th scope="col">{{ __('Number of questions') }}</th>
                            <th scope="col">{{ __('Author') }}</th>
                            <th scope="col" class="text-center">{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($courses && $courses->count() > 0)
                            @foreach ($courses as $course)
                            <tr>
                                <td>{{$course->name }}</td>
                                <td>{{$course->level->level}}</td>
                                <td class="text-center">{{$course->countQuestions() }}</td>
                                <td>{{Auth::user()->name}}</td>
                                <td class="d-flex justify-content-center align-items-center">
                                    <div>
                                    <a href="{{ route('course-preview', $course->id) }}" class="btn actions mb-2"><i class="far fa-file"></i> {{ __('Preview') }}</a>
                                </td>
                            </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="5">{{_('This Course Group have no courses yet') }}</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>   
</div>
