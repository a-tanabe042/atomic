<!DOCTYPE html>
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @if(app('env')=='local')
            <link rel="stylesheet" href="{{ asset('css/bootstrap-4.1.3.min.css') }}">
            <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
            <script src="{{ asset('js/app.js')}}"></script>
        @endif
        @if(app('env')=='production')
            <link rel="stylesheet" href="{{ secure_asset('css/bootstrap-4.1.3.min.css') }}">
            <script src="{{ secure_asset('js/jquery-3.6.0.min.js') }}"></script>
            <script src="{{ secure_asset('js/app.js')}}"></script>
        @endif
        <title>レジュメログイン画面</title>
    </head>


    @extends('layouts.app')

    @section('content')
    <body onload="screen_size_get()">
        <div class="container-fluid login-body">
            <div class="row login-main">
                <div class=" col-md-6" id="login-screen">
                    <div class="">
                        <div class="card login-width">
                            <div class="login-header">{{ __('Login') }}</div>

                            <form method="POST" action="{{ route('login') }}">
                            @csrf
                                <div class="card-body">
                                    {{-- エラーメッセージ --}}
                                    @if(session('login_error'))
                                    <div id="error_explanation" class="text-danger">
                                        <ul>
                                            <li>{{session('login_error')}}</li>
                                        </ul>
                                    </div>
                                    @endif

                                        <div class="m-4">
                                            <div>
                                            </div>
                                            <div class="">
                                                <input id="email" type="email" placeholder="Email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="m-4">

                                            <div class="">
                                                <input id="password" type="password" placeholder="Password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    <div class="m-4 mt-5">
                                        <div class="text-center m-auto">
                                            <button type="submit" class="btn btn-hover login-btn">
                                                {{ __('Login') }}
                                            </button>
                                        </div>
                                    </div>
                                    <div class="m-4">
                                        <div class="text-center p-1">
                                            <span class="g-text">saltoアカウントをお持ちの方はこちら</span>
                                        </div>
                                        <div class="text-center m-auto g-btn g-btn-hover">
                                            <a href="{{ url('login/google') }}" class="g-login-btn">
                                                <img src="{{ asset('img/google.svg') }} ">
                                                Sign in with Google
                                            </a>
                                        </div>
                                    </div>    
                                </div>
                                
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 news-bg">
                    <div class="mt-3 p-3">
                        <h3 class="news-title">お知らせ</h3>
                        <div class="news p-3 mt-3 mb-5">
                            <h4 class="news-subtitle">2022/11/10(木)</br></h4>
                            <span>
                                下記修正をリリースいたしました。</br>
                                ・ログイン画面デザイン修正</br>
                                ・その他微修正</br>
                            </span>
                        </div>
                        <div class="news p-3 mt-3 mb-5">
                            <h4 class="news-subtitle">2022/10/27(木)</br></h4>
                            <span>
                                下記修正をリリースいたしました。</br>
                                ・一覧画面フィルタ機能</br>
                                ・カレンダー招待機能</br>
                                ・希望条件入力機能</br>
                                ・企業情報登録機能</br>
                                ・バグ修正</br>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
    @endsection
</html>
