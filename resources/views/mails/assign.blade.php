<div style="text-align:center; padding-top:40px ;">
    <img src="{{ $message->embed(public_path() . '/img/small_logo.png') }}">
    <h2 style="text-align:center;font-size:40px;font-weight:700;color:#e4601c;margin-bottom:0px">{{_('Welcome to Educatioo.com ')}}<br>{{_('Teaching & Assessment Platform')}}</h2>
    <h3 style="text-align:center;font-size:25px;font-weight:600;margin-top:10px">{{$user->name}}</h3>

    <p>You have been added to the following group</p>
    <h3 style="text-align:center;font-size:25px;font-weight:600;margin-top:10px">{{$class}}</h3>

    <p>This is your PIN</p>
    <h2 style="text-align:center;font-size:40px;font-weight:700;color:#e4601c;margin-bottom:40px">{{$pin}}</h2>

    <div style="margin-bottom:40px">If you are invited to take a course as a member of this group, <br> you will need this PIN to identify yourself. <br> We wish you lots of success using the Educatioo Platform</div>

</div>