<div class="content-wrapper">
    <div class="row">
        <div class="d-flex justify-content-end">
            <button class="bt badge badge-success mb-3" type="button">
                <i class="mdi mdi-account-plus mr-2"></i>
                {{ __('Add new trainer') }}
            </button>
        </div>
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{ __('Trainers') }}</h4>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>
                                        {{ __('Name') }}
                                    </th>
                                    <th>
                                        {{ __('Email') }}
                                    </th>
                                    <th>
                                        {{ __('Land') }}
                                    </th>
                                    <th>
                                        {{ __('Students') }}
                                    </th>
                                     <th>
                                        {{ __('Quiz') }}
                                    </th>
                                    <th>
                                        {{ __('Last Session') }}
                                    </th>
                                    <th>
                                        {{ __('Plan') }}
                                    </th>
                                    <th>
                                        {{ __('Subscription') }}
                                    </th>
                                    <th>
                                        {{ __('Actions') }}
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($trainers->isNotEmpty()) 
                                    @foreach ($trainers as $user)
                                    <tr>
                                        <td class="py-1">
                                            {{ $user->name }}
                                        </td>
                                        <td>
                                            {{ $user->email }}
                                        </td>
                                        <td class="lowercase">
                                            {{ $user->land->name }}
                                        </td>
                                        <td>
                                            {{ $user->total_students }}
                                        </td>
                                        <td>
                                            {{ $total_quiz }}
                                        </td>
                                        <td>
                                            {{ $user->last_session }}
                                        </td>
                                        <td>
                                            @if(!empty($user->plan))
                                                {{ $user->plan->name}}
                                            @else
                                                {{ __('None') }}
                                            @endif
                                        </td>
                                        <td>
                                            {{ $user->subscription_date }}
                                        </td>
                                        <td>
                                            <button class="bt badge badge-warning "><i class=" mdi mdi-pencil-box-outline"></i> {{ __('Edit') }}</button>
                                            <button class="bt badge badge-danger"><i class=" mdi mdi-minus-circle-outline"></i> {{ __('Delete') }}</button>
                                            <button class="bt badge badge-danger"><i class=" mdi mdi-minus-circle-outline"></i> {{ __('Cancel') }}</button>
                                        </td>
                                    </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="9">
                                            <div class="text-center text-muted mt-5 mb-5"><em>{{__('You don\'t have trainers added yet')}}</em></div>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if($trainers->isNotEmpty())
    <div class="row">
        <div class="col-12 text-center">
            {{ $trainers->onEachSide(0)->links() }}
        </div>
    </div>
    @endif    
</div>


