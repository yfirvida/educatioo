<div class="content-wrapper">
    <div class="row">
        <div class="d-flex justify-content-end">
            <button class="bt badge badge-warning mb-3" type="button">
                <i class=" mdi mdi-pencil-box-outline"></i> {{ __('Edit') }}
            </button>
        </div>
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{ __('Profile') }}</h4>
                    <div class="row">
                        <div class="col-md-4 profile-wrapper">
                            <figure class="profile-pic">
                                <img src="{{$user->image }}" alt="{{$user->name}}">
                            </figure>
                        </div>
                        <div class="col-md-8">
                            <table class="table">
                                <tr>
                                    <td><strong>{{ __('Name') }}</strong></td>
                                    <td>{{$user->name}}</td>
                                </tr>
                                <tr>
                                    <td><strong>{{ __('Email') }}</strong></td>
                                    <td>{{$user->email}}</td>
                                </tr>
                                <tr>
                                    <td><strong>{{ __('Country') }}</strong></td>
                                    <td class="lowercase">{{$user->land->name}}</td>
                                </tr>
                                <tr>
                                    <td><strong>{{ __('Role') }}</strong></td>
                                    <td>{{$user->role}}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>    
</div>


