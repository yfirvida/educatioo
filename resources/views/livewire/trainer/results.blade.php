<div>
    <div class="content-wrapper">
        <div class="content b-bottom pb-4">
            <div class="d-flex justify-content-between align-items-center mt-3 ">
                <h2 class="mb-3">{{ __('Name Course Group') }}</h2>
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
                        <tr>
                            <td>Lorem Ipsum</td>
                            <td class="text-center">23</td>
                            <td>12/05/2022 14:00</td>
                            <td>12/05/2022 15:00</td>
                            <td class="d-flex justify-content-center align-items-center">
                                <div>
                                    <a href="" class="btn actions mb-2"><i class="fas fa-edit"></i> {{ __('Edit') }}</a>
                                    <button class="btn actions mb-2"><i class="far fa-clock"></i> {{ __('End now') }}</button>
                                    <button class="btn actions mb-2"><i class="fas fa-user-edit"></i> {{ __('View') }}</button>
                                    <button class="btn actions"><img src="/img/archive-orange.png"> {{ __('Archive') }}</button>
                                </div> 
                            </td>
                        </tr>
                        <tr>
                            <td>Lorem Ipsum 2</td>
                            <td class="text-center">30</td>
                            <td>12/05/2022 14:00</td>
                            <td>12/05/2022 15:00</td>
                            <td class="d-flex justify-content-center align-items-center">
                                <div>
                                    <a href="" class="btn actions mb-2"><i class="fas fa-edit"></i> {{ __('Edit') }}</a>
                                    <button class="btn actions mb-2"><i class="far fa-clock"></i> {{ __('End now') }}</button>
                                    <button class="btn actions mb-2"><i class="fas fa-user-edit"></i> {{ __('View') }}</button>
                                    <button class="btn actions"><img src="/img/archive-orange.png"> {{ __('Archive') }}</button>
                                </div> 
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

