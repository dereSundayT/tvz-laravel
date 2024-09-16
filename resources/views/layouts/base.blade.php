<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <title>{{config('app.name')}}  - @yield('title','Home')</title>
        @include('layouts.utils.head')
    </head>

    <body>

        @yield('base-content')


        @include('layouts.utils.foot')
    </body>
</html>
