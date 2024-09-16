@extends('layouts.base')


@section('base-content')

<main>
    <div class="container">
        <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                        <div class="d-flex justify-content-center py-4">
                            <a href="{{route('admin.login')}}" class="logo d-flex align-items-center w-auto">
                                <img src="{{asset('assets/img/logo.png')}}" alt="">
                                <span class="d-none d-lg-block">{{ config('app.name') }}</span>
                            </a>
                        </div><!-- End Logo -->

                        <div class="card mb-3">

                            <div class="card-body">

                                @include('layouts.utils.alert')

                                <div class="pt-4 pb-2">
                                    <h5 class="card-title text-center pb-0 fs-6">Login to Your Account</h5>
                                    <p class="text-center small">Enter your email & password to login</p>
                                </div>



                                <form class="row g-3" method="post" action="{{route('admin.login')}}">
                                    @csrf
                                    <div class="col-12">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" name="email" class="form-control" id="yourEmail" value="{{old('email')}}" required>
                                        <div class="invalid-feedback">Please enter your email.</div>
                                    </div>

                                    <div class="col-12">
                                        <label for="yourPassword" class="form-label">Password</label>
                                        <input type="password" name="password" class="form-control" id="yourPassword" required>
                                        <div class="invalid-feedback">Please enter your password!</div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="remember" value="true" id="rememberMe">
                                            <label class="form-check-label" for="rememberMe">Remember me</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button class="btn btn-primary w-100" type="submit">Login</button>
                                    </div>

                                </form>

                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </section>
    </div>
</main>
<!-- End #main -->

@endsection


