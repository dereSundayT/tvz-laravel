@extends('layouts.dashboard-layout')

@section('title', 'Home')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('panel.following')}}">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page"></li>
@endsection

@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">Following</div>
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
                        @forelse ($following as $index => $user)
                            <tr>
                                <td> {{$index+1}} </td>
                                <td>
                                    <img src="{{asset("storage/profile-image/$user->profile_photo")}}" width="35" alt="Profile" class="rounded-circle"/>
                                </td>
                                <td> {{ $user->name }} </td>
                                <td>
                                    <a class="btn btn-outline-primary btn-sm" href="{{ route('home.profile', $user->username) }}">View Profile</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">No users found.</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="card-footer">
                    <div class="pull-right float-end">
                        {{ $following->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection












