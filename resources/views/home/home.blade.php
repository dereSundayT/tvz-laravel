<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Profile Card</title>
    <style>
        /* Custom styles for the card */
        .profile-card {
            border-radius: 15px;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
        }
        .profile-image {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            margin-right: 15px;
            object-fit: cover;
        }
        .verified-badge i {
            color: #fff;
            font-size: 10px;
        }
        .profile-info {
            flex-grow: 1;
        }
        .profile-name {
            font-weight: bold;
            margin-bottom: 0;
        }
        .profile-department {
            color: #4e8dbd;
            border : 0.02rem solid #4f4fe1;
            border-radius: 5px;
            padding: 5px;
            font-size: 12px;
            text-decoration: none;

        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg  card bg-white py-4">
    <div class="container">
        <!-- Logo Text -->
        <a class="navbar-brand" href="{{route('home')}}">Tvz</a>

        <!-- Toggle button for mobile view -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar Links -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                @auth()
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('panel.home') }}">Dashboard</a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-primary text-white ms-2" href="{{ route('register') }}">Register</a>
                    </li>
                @endauth

            </ul>
        </div>
    </div>
</nav>


<div class="container mt-5">
{{--    justify-content-center--}}
    <div class=" py-5 px-5">
        <div class="card-body">
            <div class="row ">
                @forelse($users as $user)
                    <div class="col-md-3 my-3">
                        <div class="profile-card px-2 py-4">
                            <!-- Profile Image -->
                            <div class="position-relative">
                                @if($user->profile_photo)
                                    <img src="{{ asset("storage/profile-image/$user->profile_photo")}}" alt="Donna Hicks" class="profile-image">
                                @else
                                    <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Donna Hicks" class="profile-image">
                                @endif



                            </div>

                            <!-- Profile Info -->
                            <div class="profile-info">
                                <p class="profile-name mb-3">
                                    {{ \Illuminate\Support\Str::limit($user->name, 20, '...') }}
                                </p>
                                <a href="{{route('home.profile', $user->username)}}" class="profile-department card-link">View Profile</a>
                            </div>

                        </div>
                    </div>
                @empty
                @endforelse

            </div>
        </div>
        <hr/>
        <div class="w-100  mx-0">
            {{ $users->links('pagination::bootstrap-4') }}
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css">
</body>
</html>
