<div>
    <div class="content-wrapper">
        <div class="content b-bottom pb-4">
            <h2>{{ __('Courses Archive') }}</h2>
            <div class="d-flex justify-content-between align-items-center mt-3 ">
                <form class="d-none d-sm-inline-block form-inline mw-100 navbar-search">
                    <div class="input-group">
                        <i class='fas fa-search'></i>
                        <input type="text" class="form-control search-input" placeholder="Search..." >
                    </div>
                </form>  
                <a href="{{ route('newcourse') }}" class="btn btn-orange" >
                    <img src="/img/quiz.png">
                    {{ __('Add new quiz') }}
                </a>
            </div>
        </div>
        <div class="content">
            <div class="table-responsive mt-4">
                <table class="table  ">
                    <thead>
                        <tr>
                            <th scope="col">Name Quiz</th>
                            <th scope="col">Course Group</th>
                            <th scope="col">Points</th>
                            <th scope="col">Start Date</th>
                            <th scope="col">End Date</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Lorem Ipsum</td>
                            <td>Classroom 1</td>
                            <td>6</td>
                            <td>17/01/2022</td>
                            <td>20/01/2022</td>
                            <td>
                                <button  class="btn actions mb-2"><i class="fas fa-edit"></i> {{ __('Edit') }}</button>
                                <button class="btn actions" "><i class="fas fa-minus"></i> {{ __('Delete') }}</button>
                            </td>
                        </tr>
                        <tr>
                            <td>Lorem Ipsum 2</td>
                            <td>Classroom 2</td>
                            <td>7</td>
                            <td>17/01/2022</td>
                            <td>22/01/2022</td>
                            <td>
                                <button  class="btn actions mb-2"><i class="fas fa-edit"></i> {{ __('Edit') }}</button>
                                <button class="btn actions"><i class="fas fa-minus"></i> {{ __('Delete') }}</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

