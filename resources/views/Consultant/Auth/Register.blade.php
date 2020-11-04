@extends('template')

@section('content')

<form action="{{route('register-cons')}}" method="post">
    @csrf
    <input placeholder="email" type="email" value="{{old('email')}}" name="email" id="">
    <input placeholder="first_name" type="text" value="{{old('first_name')}}" name="first_name" id="">
    <input placeholder="last_name" type="text" value="{{old('last_name')}}" name="last_name" id="">
    <input placeholder="education" type="text" value="{{old('education')}}" name="education" id="">
    <input placeholder="passowrd" type="password" name="password" id="">
    <button type="submit">Register</button>
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

@endsection