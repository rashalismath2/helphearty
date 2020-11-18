<div class="containers-layout" >
    <h1 class="main-cont-header">
        Our team,
    </h1>

    <div class="cont-left">
        <p class="mt-4 team-desc">
            <span class="ml-5 font-weight-bold">
              Connect with a board certified Psychiatrist 24 hours a day using our
              platform.
            </span>
            <br />
            Our experienced physicians have been providing quality medical advice to
            those in need since 2014. Your Doctors Online is the passion project of
            our founders to bring affordable healthcare to all of the corners of the
            world. We believe that everyone in the world should have the ability to
            connect with an experienced doctor.
        </p>
    </div>
    <div class="cont-right">
        <div id="carouselExampleSlidesOnly" class="carousel slide mt-4" data-ride="carousel">
            <div class="carousel-inner">
                @for ($i = 0; $i < count($consultants); $i++)
                    <div class="carousel-item {{$i==0?'active':''}}">
                        <div class="team-card clearfix" >
                            <img class="team-doc-img " src="{{$consultants[$i]->profile_id}}" alt="Card image cap" />
                            <div class="team-card-body">
                              <h5 class="team-doc-name card-title">{{$consultants[$i]->first_name}}</h5>
                              <p class="team-doc-education">({{$consultants[$i]->education}})</p>
                              <p class="card-text">{{$consultants[$i]->bio}}</p>
                            </div>
                          </div>
                    </div>
                @endfor
            </div>
          </div>
    </div>

</div>