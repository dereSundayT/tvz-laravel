@extends('layouts.base')
@section('base-content')
    <main>
        <div class="container">

            <section class="section error-404 min-vh-100 d-flex flex-column align-items-center justify-content-center">
                <h1>404</h1>
                <h2>
                    {{$message}}
                </h2>
                <a class="btn" href="{{route('home')}}">Back to home</a>
                <img src="{{asset('assets/img/not-found.svg')}}" class="img-fluid py-5" alt="Page Not Found">
            </section>

        </div>
    </main>
@endsection

