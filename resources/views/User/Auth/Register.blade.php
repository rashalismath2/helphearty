@extends('template')

@section('content')

<form action="{{route('register')}}" method="post">
    @csrf
    <input placeholder="email" type="email" value="{{old('email')}}" name="email" id="">
    <input placeholder="name" type="text" value="{{old('name')}}" name="name" id="">
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