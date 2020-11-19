@extends('template')

@section('content')

<div class="cont">
    <div id="consultants-card-cont">
        @foreach ($consultants as $consultant)
                <div class="team-card consultants-card clearfix" >
                    <img class="team-doc-img " src="{{$consultant->profile_id}}" alt="Card image cap" />
                    <div class="team-card-body">
                        <h5 class="team-doc-name card-title">Name: {{$consultant->first_name}}</h5>
                        <p class="team-doc-education">Edu: ({{$consultant->education}})</p>
                        <p class="team-doc-education">Started on: {{$consultant->created_at->toDateString()}}</p>
                        <p class="team-doc-education">Served for: <span class="bg-danger px-2 text-white">{{$consultant->served_count}}</span> clients</p>
                        <button  data-toggle="modal" data-target="#consultant-{{$consultant->email}}" class="select-consultants-button auth-buttons">More</button>
                        <form action="{{route('save-counsellor')}}" method="post">
                            @csrf
                            <input type="hidden" value="{{$consultant->id}}" name="counsellor_id">
                            <button type="submit" class="select-consultants-button auth-buttons">Select</button>
                        </form>
                    </div>
                </div>
    
                <div class="modal fade" id="consultant-{{$consultant->email}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">{{$consultant->first_name}} {{ $consultant->last_name}}</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                            <div class="team-card consultants-details clearfix" >
                                <img class="team-doc-img " src="{{$consultant->profile_id}}" alt="Card image cap" />
                                <div class="team-card-body ">
                                    <h5 class="team-doc-name card-title">First name: {{$consultant->first_name}}</h5>
                                    <h5 class="team-doc-name card-title">Last name: {{$consultant->last_name}}</h5>
                                    <p class="team-doc-education">Edu: ({{$consultant->education}})</p>
                                    <p class="team-doc-education">Started on: {{$consultant->created_at->toDateString()}}</p>
                                    <p class="team-doc-education">Served for: <span class="bg-danger px-2 text-white">{{$consultant->served_count}}</span> clients</p>
                                    <p class="card-text">{{$consultant->bio}}</p>
                                </div>
                            </div>
                        </div>
                      </div>
                    </div>
                </div>

        @endforeach
    </div>
</div>


@endsection