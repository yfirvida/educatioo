<div>
    <div class="content-wrapper">
        <div class="content b-bottom pb-4">
            <h2 class="mb-3">{{ __('Courses Archive') }}</h2>
            <div class="d-flex justify-content-between align-items-center mt-3 ">
                <form class="d-none d-sm-inline-block form-inline mw-100 navbar-search">
                    <div class="input-group">
                        <i class='fas fa-search'></i>
                        <input type="text" class="form-control search-input" placeholder="Search..." >
                    </div>
                </form> 
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
                            <th scope="col" class="text-center">{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Lorem Ipsum</td>
                            <td class="text-wrap">Quisque velit nisi, pretium ut lacinia in, elementum id enim</td>
                            <td class="text-center">23</td>
                            <td>12/05/2022 14:00</td>
                            <td>12/05/2022 15:00</td>
                            <td class="d-flex justify-content-center align-items-center">
                                <div>
                                    <a href="#" class="btn actions mb-2"><i class="fas fa-edit"></i> {{ __('Edit') }}</a>
                                    <button class="btn actions mb-2"><i class="fas fa-minus"></i> {{ __('Delete') }}</button>
                                </div> 
                            </td>
                        </tr>
                        <tr>
                            <td>Lorem Ipsum 2</td>
                            <td class="text-wrap">Quisque velit nisi, pretium ut lacinia in, elementum id enim</td>
                            <td class="text-center">30</td>
                            <td>12/05/2022 14:00</td>
                            <td>12/05/2022 15:00</td>
                            <td class="d-flex justify-content-center align-items-center">
                                <div>
                                    <a href="#" class="btn actions mb-2"><i class="fas fa-edit"></i> {{ __('Edit') }}</a>
                                <button class="btn actions mb-2"><i class="fas fa-minus"></i> {{ __('Delete') }}</button>
                                </div> 
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


