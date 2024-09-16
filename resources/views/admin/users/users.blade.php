@extends('layouts.dashboard-layout')

@section('title', 'User Management')

    @section('breadcrumb')
        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">User Management</li>
    @endsection

    @section('content')
        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">

                        <div class="card-body">

                            <div class="card-header d-flex justify-content-between">
                                <h5>Users</h5>
                                <a class="btn btn-outline-dark btn-sm " data-bs-toggle="modal" data-bs-target="#exampleModal">Add User</a>
                            </div>

                            @include('admin.users.add-user')


                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Profile Image</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Profile Mode</th>
                                        <th scope="col">Last Login</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @forelse ($users as $index => $user)
                                        <tr>
                                            <td> {{$index +1}} </td>
                                            <td> <img src="{{asset('assets/img/profile-img.jpg')}}" width="35" alt="Profile" class="rounded-circle"> </td>
                                            <td> {{ $user->name }} </td>
                                            <td> {{ $user->email }} </td>
                                            <td> {!! $user->is_private_profile ? '<span class="badge bg-success">Yes</span>' :'<span class="badge bg-info text-white">No</span>' !!} </td>
                                            <td> {{ $user->last_login_at }} </td>
                                            <td>
                                                <a class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#view-user-{{$user->id}}">View</a>
                                                <a class="btn btn-outline-info    btn-sm" data-bs-toggle="modal" data-bs-target="#edit-user-{{$user->id}}">Edit</a>
                                                <a class="btn btn-outline-danger  btn-sm" data-bs-toggle="modal" data-bs-target="#delete-user-{{$user->id}}">Delete</a>
                                            </td>
                                            @include('admin.users.delete-user')
                                            @include('admin.users.edit-user')
                                            @include('admin.users.view-user')
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="2">No users found.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>

                        </div>
                        {{-- End Of Card Body --}}

                        <div class="card-footer">
                            <div class="pull-right float-end">
                                {{ $users->links('pagination::bootstrap-4') }}
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
    @endsection

