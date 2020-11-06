@extends('template')

@section('content')
<div class="cont">

    <form action="{{route('login-cons')}}" method="post">
        @csrf
        <input placeholder="email" type="email" value="{{old('email')}}" name="email" id="">
        <input placeholder="passowrd" type="password" name="password" id="">
        <button type="submit">Login</button>
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
@endsection