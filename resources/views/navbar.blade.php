<nav class="shadow">
    <div class="nav-cont">
        <p class="logo"><a href="{{route('welcome')}}">HelpHearty</a></p>
        <div id="nav-options">
            <div id="nav-links-cont">
                <div id="nav-links">
                    <a href="http://google.com">About</a>
                    <a href="http://google.com">Reviews</a>
                    <a href="http://google.com">FAQ</a>
                    <a href="http://google.com">Contact</a>
                    <a href="http://google.com">Counselor Jobs</a>
                </div>
            </div>
            @if(Auth::guard('web')->check())
                <div class="dropdown nav-button-cont">
                    <button class="nav-button dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Hi, {{Auth::guard('web')->user()->name}}
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="#">Profile</a>
                        <a class="dropdown-item" href="{{route('home')}}">Messages</a>
                        <form action="{{route('logout')}}" method="post">
                            @csrf
                            <input type="hidden" name="guard" value="web">
                            <button class="dropdown-item" >Logout</button>
                        </form>
                    </div>
                    <input id="userEmail" type="hidden" value="{{Auth::guard('web')->user()->email}}" name="userEmail">
                </div>
            @elseif(Auth::guard('cons')->check())
                <div class="dropdown">
                    <button class="nav-button dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Hi, {{Auth::guard('cons')->user()->first_name}}
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="#">Profile</a>
                        <form action="{{route('logout-cons')}}" method="post">
                            @csrf
                            <input type="hidden" name="guard" value="cons">
                            <button class="dropdown-item" >Logout</button>
                        </form>
                    </div>
                    <input id="consEmail" type="hidden" value="{{Auth::guard('cons')->user()->email}}" name="consEmail">
                </div>
            @endif

            @if (!Auth::check())
                <a class="nav-button" target="_blank" href="{{route('login-view-cons')}}"><i class="fas fa-user fa-md"></i> Staff</a>
            @endif
        
        </div>

    </div>
</nav>