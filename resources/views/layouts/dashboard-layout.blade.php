<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <title>{{config('app.name')}} - @yield('title','Home')</title>
        @include('layouts.utils.head')
    </head>

    <body>
        @include('layouts.utils.header')
        @include('layouts.utils.sidebar')

        <main id="main" class="main">
            <div class="pagetitle">
                <h1>@yield('title','Home')</h1>
                <div class="breadcrumb">
                    <ol class="breadcrumb">
                        @yield('breadcrumb')
                    </ol>
                </div>
            </div>

            @include('layouts.utils.alert')
            @yield('content')
        </main>

        @include('layouts.utils.foot')
    </body>
</html>




