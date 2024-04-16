
@extends('layouts.templateLogin')

@section('title', 'ログイン')
@include('layouts.head')

@section('content')
    <section class="row login-main">
        <article class="col-md-6 login-body" id="login-screen">
            <div class="card login-width">
                <div class="login-header">{{ __('Login') }}</div>

                <form method="POST" action="{{ route('login') }}">
                @csrf
                    <div class="card-body">
                        {{-- メッセージ --}}
                        @if(session('flash_message'))
                        <div class="alert alert-{{ session('flash_message_type') }} text-error">
                            <span>{{ session('flash_message') }}</span>
                        </div>
                        @endif

                        <div class="m-4">
                            <input id="email" type="email" placeholder="Email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        </div>
                        <div class="m-4">
                            <input id="password" type="password" placeholder="Password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
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
        </article>
        @include('announcement')
    </section>
@endsection
