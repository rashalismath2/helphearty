@extends('template')

@section('content')
<div class="cont clearfix">
    <div class="cont-left intro-cont-left">
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
           @if (!auth()->check())
            <a class="auth-buttons" ><i class="fas fa-user-plus fa-md"></i> Register</a>
            <a data-toggle="modal" data-target="#userLogin" class="auth-buttons" ><i class="fas fa-sign-in-alt fa-md"></i> Login</a>
           @endif
        </div>
        @include('User.Auth.Login')
    </div>
</div>

<div class="cont clearfix">
    @include('Home.need')    
</div>

<div class="cont clearfix">
    @include('Home.team')    
</div>

<div class="cont clearfix">
    @include('Home.service')    
</div>

@include('footer')


@endsection