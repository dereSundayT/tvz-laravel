@extends('layouts.dashboard-layout')

@section('title', 'Profile')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('panel.home')}}">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">My Profile</li>
@endsection

@section('content')
    <section class="section profile">
        <div class="row">
            <div class="col-xl-4">
                <div class="card">
                    <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                        <img src="{{asset("storage/profile-image/$user->profile_photo")}}" alt="Profile" class="rounded-circle">
                        <h2>{{$user->name}}</h2>
{{--                        <h3>{{$user->username}}</h3>--}}
{{--                        <div class="social-links mt-2">--}}
{{--                            <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>--}}
{{--                            <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>--}}
{{--                            <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>--}}
{{--                            <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>--}}
{{--                        </div>--}}
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

                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
                            </li>

                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-settings">Settings</button>
                            </li>

                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change Password</button>
                            </li>
                        </ul>

                        <div class="tab-content pt-2">
                            @include('user-panel.profile.profile-details')
                            @include('user-panel.profile.edit-profile')
                            @include('user-panel.profile.settings')
                            @include('user-panel.profile.change-password')
                        </div>
                        <!-- End Bordered Tabs -->
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection


