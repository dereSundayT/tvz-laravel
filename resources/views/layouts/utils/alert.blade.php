@if ($errors->any())
    <div class="alert alert-danger my-2">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if(session('success'))
    <div class="alert alert-success my-2">{{ session('success') }}</div>
@endif


@if (session('error'))
    <div class="alert alert-danger my-2">
        {{ session('error') }}
    </div>
@endif



