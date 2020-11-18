<div class="modal fade" id="userLogin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content login-content">

        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">HelpHearty - Login</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
            <form action="{{route('login')}}" method="post">
                @csrf
                <input placeholder="email" type="email" value="{{old('email')}}" name="email" id="">
                <input placeholder="passowrd" type="password" name="password" id="">
                <input class="auth-buttons" type="submit" />
            </form>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>

      </div>
    </div>
  </div>

