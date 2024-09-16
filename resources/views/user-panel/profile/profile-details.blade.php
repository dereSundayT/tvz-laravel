<div class="tab-pane fade show active profile-overview" id="profile-overview">
    <h5 class="card-title">About</h5>
    <p class="small fst-italic">
     {{$user->about_me??'N/A'}}
    </p>

    <h5 class="card-title">Profile Details</h5>

    <div class="row">
        <div class="col-lg-3 col-md-4 label ">Full Name</div>
        <div class="col-lg-9 col-md-8">{{$user->name}}</div>
    </div>


    <div class="row">
        <div class="col-lg-3 col-md-4 label">Email</div>
        <div class="col-lg-9 col-md-8">{{$user->email}}</div>
    </div>

    <div class="row">
        <div class="col-lg-3 col-md-4 label">Username</div>
        <div class="col-lg-9 col-md-8">{{$user->username}}</div>
    </div>

    <div class="row">
        <div class="col-lg-3 col-md-4 label">Joined On</div>
        <div class="col-lg-9 col-md-8">
            {{ date('d/m/Y', strtotime($user->registered_at)) }}
        </div>
    </div>

</div>
