@extends('template')

@section('content')

<div class="cont">
    <div id="questions-answers">
        <h2 class="problem-title">Please take a minute to answer these questions. These questions are given by the consellor you have chose</h2>
        <form action="{{route('save-answers')}}" method="post">
            @csrf
            <ol>
                @foreach ($questions as $question)
                    <li>
                        <p>{{$question->question}}</p>
                        @if ($question->answer_type=="big")
                            <textarea name="{{$question->id}}" placeholder="Answer"></textarea>
                        @else
                            <input placeholder="Answer" type="text"  name="{{$question->id}}" />
                        @endif
                    </li>    
                @endforeach
            </ol>
            <button class="auth-buttons">Submit</button>
        </form>
    </div>
</div>

@endsection