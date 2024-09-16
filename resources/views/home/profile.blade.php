@extends('layouts.base')
@section('base-content')
<main class="p-5">

    <div class="pagetitle">
        <h1>Profile Details</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                <li class="breadcrumb-item active">Profile</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
        <div class="row">
            <div class="col-xl-4">

                <div class="card">
                    <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

                        @if($user->profile_photo)
                            <img src="{{ asset("storage/profile-image/$user->profile_photo")}}" alt="Profile" class="rounded-circle">
                        @else
                            <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Profile" class="rounded-circle">
                        @endif

                        <h2>{{$user->name}}</h2>
                        <h6>{{$user->username}}</h6>

                        <div class=" mt-1 px-5">
                            @if(Auth::check())
                                @if(Auth::user()->following()->where('followed_id', $user->id)->exists())
                                    <!-- Unfollow button -->
                                    <form action="{{ route('users.unfollow', $user->id) }}" method="post">
                                        @csrf
                                        <button type="submit" class="btn btn-danger">Unfollow</button>
                                    </form>
                                @else
                                    <!-- Follow button -->
                                    <form action="{{ route('users.follow', $user->id) }}" method="post">
                                        @csrf
                                        <button type="submit" class="btn btn-primary">Follow</button>
                                    </form>
                                @endif
                            @else
                                <a href="{{route('login')}}" class="link-text"><i>Login to follow this user</i></a>
                            @endif

                        </div>

                    </div>
                </div>

            </div>

            <div class="col-xl-8">

                <div class="card">
                    <div class="card-body pt-3">
                        <!-- Bordered Tabs -->
                        <ul class="nav nav-tabs nav-tabs-bordered">
                            <li class="nav-item">
                                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
                            </li>
                        </ul>

                        <div class="tab-content pt-2">

                            <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                <h5 class="card-title">About Me</h5>
                                <p class="small fst-italic">
                                    {{$user->about_me}}
                                </p>

                                <h5 class="card-title">Profile Details</h5>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">Name</div>
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

                        </div>
                        <!-- End Bordered Tabs -->
                    </div>
                </div>

            </div>
        </div>
    </section>

</main>
@endsection

