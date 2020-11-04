@extends('template')

@section('content')
<div class="cont">
    <div class="cont-left">
        <h2>HelpHearty,</h2>
        <p class="">
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
            <button>SignUp</button>
            <button>SignIn</button>
        </div>
    </div>
</div>    


@endsection