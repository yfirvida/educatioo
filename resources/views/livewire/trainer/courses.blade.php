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
                        <tr>
                            <td>Lorem Ipsum</td>
                            <td>Level 1</td>
                            <td>6</td>
                            <td>Author 1</td>
                            <td class="d-flex justify-content-center align-items-center">
                                <div>
                                <a href="{{ route('course-preview') }}" class="btn actions mb-2"><i class="far fa-file"></i> {{ __('Preview') }}</a>
                                <a href="{{ route('edit-course') }}" class="btn actions mb-2"><i class="fas fa-edit"></i> {{ __('Edit') }}</a>
                                <button class="btn actions mb-2"><i class="fas fa-minus"></i> {{ __('Delete') }}</button>
                                <button class="btn actions"><i class="fas fa-share-alt"></i> {{ __('Share') }}</button>
                                </div> 
                            </td>
                        </tr>
                        <tr>
                            <td>Lorem Ipsum 2</td>
                            <td>Level 2</td>
                            <td>7</td>
                            <td>Author 1</td>
                            <td class="d-flex justify-content-center align-items-center">
                                <div>
                                <a href="{{ route('course-preview') }}" class="btn actions mb-2"><i class="far fa-file"></i> {{ __('Preview') }}</a>
                                <a href="{{ route('edit-course') }}" class="btn actions mb-2"><i class="fas fa-edit"></i> {{ __('Edit') }}</a>
                                <button class="btn actions mb-2"><i class="fas fa-minus"></i> {{ __('Delete') }}</button>
                                <button class="btn actions"><i class="fas fa-share-alt"></i> {{ __('Share') }}</button>
                                </div> 
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
