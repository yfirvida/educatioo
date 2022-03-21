<div style="text-align:center; padding-top:40px ;">
    <img src="{{ $message->embed(public_path() . '/img/small_logo.png') }}">
    <h2 style="text-align:center;font-size:40px;font-weight:700;color:#e4601c;margin-bottom:0px">{{_('Welcome to Educatioo.com')}}</h2>
    <h3 style="text-align:center;font-size:25px;font-weight:600;margin-top:10px">{{$user->name}}</h3>

    <p>You have been added to the following group</p>
    <h3 style="text-align:center;font-size:25px;font-weight:600;margin-top:10px">{{$class}}</h3>

    <p>Your PIN is</p>
    <h2 style="text-align:center;font-size:40px;font-weight:700;color:#e4601c;margin-bottom:40px">{{$pin}}</h2>

    <div style="margin-bottom:40px">You can access through the following link</div>

    <a style="background-color:#2b388f;border-radius:0.25rem;color:#fff;padding:10px 45px;text-decoration:none;font-weight:700;font-size:22px;" href="{{ url('')}}">{{_('Login')}}</a>

</div>