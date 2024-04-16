<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex,nofollow,noarchive" />
    <title></title>
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

    
</head>
 
<body>
    

<!-- <div class="container">
    <div class="row"> -->
        <div class="main">
            <div class="menu">
                @include('menu')
            </div>
            @if(isset($_COOKIE["menu_keep"]) && $_COOKIE["menu_keep"] == "off")
            <div class="list-main_keep">
            @else
            <div class="list-main">
            @endif
                @yield('content')
            </div>
        </div>
    <!-- </div>
</div> -->
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    @if(app('env')=='local')
        <script src="{{ asset('js/app.js') }}"></script>
        <script src="{{ asset('js/popper-1.16.1.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap-4.6.2.min.js') }}"></script>
    @endif
    @if(app('env')=='production')
        <script src="{{ secure_asset('js/app.js') }}"></script>
        <script src="{{ secure_asset('js/popper-1.16.1.min.js') }}"></script>
        <script src="{{ secure_asset('js/bootstrap-4.6.2.min.js') }}"></script>
    @endif
</body>
</html>