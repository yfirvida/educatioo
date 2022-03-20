<div style="text-align:center; padding-top:40px ;">
    <img src="{{ $message->embed(public_path() . '/img/small_logo.png') }}">
    <h2 style="text-align:center;font-size:40px;font-weight:700;color:#e4601c;margin-bottom:0px">{{_('Welcome to Educatioo.com')}}</h2>
    <h3 style="text-align:center;font-size:25px;font-weight:600;margin-top:10px">{{$user->name}}</h3>

    <div style="margin-bottom:40px"><?php echo nl2br($plan->intro); ?></div>


    @if($plan->link != null) 
        <a style="background-color:#2b388f;border-radius:0.25rem;color:#fff;padding:10px 45px;text-decoration:none;font-weight:700;font-size:22px;" href="{{$plan->link}}">{{_('Plan Upgrade')}}</a>
    @endif


    <p style="margin-top:50px">{{_('Thanks for choose')}} {{ config('app.name') }}</p>
</div>