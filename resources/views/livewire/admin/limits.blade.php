<div>
    <div class="content-wrapper">
    @if (session()->has('message'))
        <div class="alert alert-success" style="margin-top:30px;">
          {{ session('message') }}
        </div>
    @endif
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{ __('Basic') }}</h4>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>
                                        {{ __('Groups Limit') }}
                                    </th>
                                    <th>
                                        {{ __('Courses Limit') }}
                                    </th>
                                    <th>
                                        {{ __('Students per Group') }}
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="py-1">
                                        
                                    </td>
                                    <td class="py-1">
                                        
                                    </td>
                                    <td class="py-1">
                                        
                                    </td>
                                   
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

<div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{ __('Premium') }}</h4>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>
                                        {{ __('Groups Limit') }}
                                    </th>
                                    <th>
                                        {{ __('Courses Limit') }}
                                    </th>
                                    <th>
                                        {{ __('Students per Group') }}
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="py-1">
                                        
                                    </td>
                                    <td class="py-1">
                                        
                                    </td>
                                    <td class="py-1">
                                        
                                    </td>
                                   
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


</div>
