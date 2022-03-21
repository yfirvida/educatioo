<div style="text-align:center; padding-top:40px ;">
    <img src="{{ $message->embed(public_path() . '/img/small_logo.png') }}">

    <p>A new course has been launched</p>
    <h2 style="text-align:center;font-size:40px;font-weight:700;color:#e4601c;margin-bottom:0px;margin-top:10px">{{$course}}</h2>

    <p>for the group</p>
    <h3 style="text-align:center;font-size:25px;font-weight:600;margin-top:10px">{{$class}}</h3>

    <div style="margin-bottom:40px">Available from {{$start}} to {{$end}}</div>

    <h3 style="margin-bottom: 0px;">Instructions</h3>
    <p style="margin-bottom: 40px;">{{$instructions}}</p>

    <a style="background-color:#2b388f;border-radius:0.25rem;color:#fff;padding:10px 45px;text-decoration:none;font-weight:700;font-size:22px;" href="{{ url('')}}">{{_('Login')}}</a>

</div>