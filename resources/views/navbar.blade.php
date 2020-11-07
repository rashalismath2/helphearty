<nav class="shadow">
    <div class="nav-cont">
        <p class="logo"><a href="{{route('welcome')}}">HelpHearty</a></p>
        @if(Auth::guard('web')->check())
            <div class="dropdown">
                <button class="nav-button dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Hi, {{Auth::guard('web')->user()->name}}
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="#">Profile</a>
                    <form action="{{route('logout')}}" method="post">
                        @csrf
                        <input type="hidden" name="guard" value="web">
                        <button class="dropdown-item" >Logout</button>
                    </form>
                </div>
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
            </div>
        @endif

        @if (!Auth::check())
            <a class="nav-button" target="_blank" href="{{route('login-view-cons')}}"><i class="fas fa-user fa-md"></i> Staff</a>
        @endif

    </div>
</nav>