@extends('template')

@section('content')
<div class="cont">
    <div class="cont-left">
        <h2 class="help-hearty-text">HelpHearty,</h2>
        <p class="help-heart-intro">
            <span class=""
              >will help you to find a professional consultant whos prepared to
              listen to you and help you.</span
            >
            <br />
            Our intention is to bring professional health advices to everyone in
            the srilanka. Professional health advices needed for everyone
            certainly in their life. We have opened a gate for you to join us
            and get advises from a registered professional consultant. We want
            help you to spend your every minute happily :)
          </p>
    </div>
    <div class="cont-right">
        <img src="{{asset('/img/intr-img.jpg')}}" alt="" srcset="">
        <div id="auth-buttons">
            <a href="{{route('register-view')}}"><i class="fas fa-user-plus fa-md"></i> Register</a>
            <a href="{{route('login-view')}}"><i class="fas fa-sign-in-alt fa-md"></i> Login</a>
        </div>
    </div>
</div>

<div class="cont">
    @include('Home.need')    
</div>


@endsection