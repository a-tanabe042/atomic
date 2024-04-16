@section('head')
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex,nofollow,noarchive" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>
        レジュメ｜@yield('title')
    </title>
    <!-- Bootstrap CSS -->
    @if(app('env')=='local')
        <link rel="stylesheet" href="{{ asset('css/bootstrap-4.1.3.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/fontawesome-5.4.2.css') }}">
        <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
        <link rel="stylesheet" href="{{ asset('css/condition.css') }}">
        <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}" />
    @endif
    @if(app('env')=='production')
        <link rel="stylesheet" href="{{ secure_asset('css/bootstrap-4.1.3.min.css') }}">
        <link rel="stylesheet" href="{{ secure_asset('css/fontawesome-5.4.2.css') }}">
        <script src="{{ secure_asset('js/jquery-3.6.0.min.js') }}"></script>
        <link rel="stylesheet" href="{{ secure_asset('css/app.css') }}">
        <link rel="stylesheet" href="{{ secure_asset('css/style.css') }}">
        <link rel="stylesheet" href="{{ secure_asset('css/condition.css') }}">
        <link rel="stylesheet" href="{{ secure_asset('css/select2.min.css') }}" />
    @endif
@endsection