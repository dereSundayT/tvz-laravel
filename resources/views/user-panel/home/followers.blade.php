@extends('layouts.dashboard-layout')

@section('title', 'Home')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('panel.followers')}}">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page"></li>
@endsection

@section('content')
    <section class="section profile">

        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header">My Followers</div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Profile Image</th>
                                <th scope="col">Name</th>
                                <th scope="col"> - </th>
                            </tr>
                            </thead>

                            <tbody>
                            @forelse ($followers as $index => $user)
                                <tr>
                                    <td> {{$index+1}} </td>
                                    <td>
                                        <img src="{{asset("storage/profile-image/$user->profile_photo")}}"
                                             width="35" alt="Profile"
                                             class="rounded-circle"
                                        />
                                    </td>
                                    <td> {{ $user->name }} </td>
                                    <td>
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('home.profile', $user->username) }}">View Profile</a>
                                    </td>
                                </tr>
                            @empty
                                <tr >
                                    <td colspan="4">No users found.</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        <div class="pull-right float-end">
                            {{ $followers->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </section>
@endsection
















