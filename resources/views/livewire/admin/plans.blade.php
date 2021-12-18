<div class="content-wrapper">
    <div class="row">
        <div class="d-flex justify-content-end">
            <button class="bt badge badge-success mb-3" type="button">
                <i class="mdi mdi-plus-circle-outline mr-2"></i>
                {{ __('Add new plan') }}
            </button>
        </div>
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{ __('Plans') }}</h4>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>
                                        {{ __('Plan') }}
                                    </th>
                                    <th>
                                        {{ __('Actions') }}
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($plans->isNotEmpty()) 
                                    @foreach ($plans as $plan)
                                    <tr>
                                        <td class="py-1">
                                            {{ $plan->name }}
                                        </td>
                                        <td>
                                            <button class="bt badge badge-warning"><i class=" mdi mdi-pencil-box-outline"></i> {{ __('Edit') }}</button>
                                            <button class="bt badge badge-danger"><i class=" mdi mdi-minus-circle-outline"></i> {{ __('Delete') }}</button>
                                        </td>
                                    </tr>
                                    @endforeach
                                @else
                  <tr>
                    <td colspan="4">
                      <div class="text-center text-muted mt-5 mb-5"><em>{{__('You don\'t have plans added yet')}}</em></div>
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
    <div class="row">
        <div class="col-12 text-center">
            {{ $plans->onEachSide(0)->links() }}
        </div>
    </div>
    
</div>


