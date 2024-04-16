<!DOCTYPE html>
<html lang="ja">
    <head>
        @yield('head')
    </head>
    <body>
        <div class="main">
            @if((session()->has('user_id')))
            <section class="menu">
                @include('menu')
            </section>
            <div @if(isset($_COOKIE["menu_keep"]) && $_COOKIE["menu_keep"] == "off") class="list-main_keep" @else class="list-main" @endif>
            @else
            <div class="mx-auto">
            @endif
                @yield('content')
            </div>
        </div>
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