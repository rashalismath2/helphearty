@extends('template')

@section('content')
    <h1>{{auth()->user()->id)}}</h1>
@endsection