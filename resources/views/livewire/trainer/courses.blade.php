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
                        @if($courses->isNotEmpty())
                            @foreach ($courses as $course)
                            <tr>
                                <td>{{$course->name }}</td>
                                <td>{{$course->level->level}}</td>
                                <td class="text-center">{{$course->countQuestions() }}</td>
                                <td>{{Auth::user()->name}}</td>
                                <td class="d-flex justify-content-center align-items-center">
                                    <div>
                                    <a href="{{ route('course-preview', $course->id) }}" class="btn actions mb-2"><i class="far fa-file"></i> {{ __('Preview') }}</a>
                                    <a href="{{ route('edit-course', $course->id) }}" class="btn actions mb-2"><i class="fas fa-edit"></i> {{ __('Edit') }}</a>
                                    <button class="btn actions mb-2" wire:click="confirm({{$course->id}})"><i class="fas fa-minus"></i> {{ __('Delete') }}</button>
                                    <button class="btn actions"><i class="fas fa-share-alt"></i> {{ __('Share') }}</button>
                                    </div> 
                                </td>
                            </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

<!-- confirm modal -->
<div wire:ignore.self class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-body pb-3">
                <div class="inside-form text-center">
                    {{_('Are you sure you want to delete this item?')}}
                </div>
            </div>
            <div class="modal-footer justify-content-center">
                <div wire:loading wire:target="delete">
                    <img src="{{ asset('star-admin/images/loading-gif.gif') }}" class="loader" />
                </div>
                <div wire:loading.remove wire:target="delete">
                    <button type="button" wire:click.prevent="delete({{$current}})" class="btn btn-orange btn-fix-size" >{{__('Delete')}}</button>
                </div>
                <button type="button" wire:click.prevent="close" class="btn btn-white btn-fix-size" >{{__('Cancel')}}</button>
            </div>
        </div>
    </div>
</div>
</div>
@push('scripts')
    <script>
        window.addEventListener('openModal', event => {         
            $('#confirmModal').modal('show');
        });

        window.addEventListener('closeModal', event => {
            $('#confirmModal').modal('hide');
        });
    </script>
@endpush