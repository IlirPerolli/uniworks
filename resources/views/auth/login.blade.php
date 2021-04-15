@extends('layouts.index')
@section('imports')
<link rel="stylesheet" href="{{asset('css/login-style.css')}}">
@endsection
@section('content')
<div class="container">

    <div class="login-container">

        <h1 class="login-title">Kyçu</h1>


        <form class="login-form" method="POST" action="{{ route('login') }}">
            @csrf
            <div class="login-form-row">
                <div class="username">
                    <label for="email" class="login-form-label">{{ __('Emaili') }}</label>
                </div>
                <div>
                    <input type="email" name="email" id="email" class="login-form-input" value="{{old('email')}}" autocomplete="off">
                    @error('email')

                    <span style="color: #e3342f; font-size: 14px; padding-left: 12px">{{ $message }}</span>

                    @enderror
                </div>
            </div>

            <div class="login-form-row">
                <div class="password">
                    <label for="password" class="login-form-label">{{ __('Fjalëkalimi') }}</label>

                </div>
                <div>

                    <input type="password" name="password" id="password" class="login-form-input">
                    @error('password')
                    <span style="color: #e3342f; font-size: 14px; padding-left: 12px">{{ $message }}</span>
                    @enderror
                    @if (Route::has('password.request'))
                        <div class="forgot-password">
                            <a href="{{ route('password.request') }}" style="text-decoration: none">
                                <p>Keni harruar fjalëkalimin?</p>
                            </a>
                        </div>
                    @endif


                </div>
{{--                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>--}}

{{--                <label class="form-check-label" for="remember">--}}
{{--                    {{ __('Remember Me') }}--}}
{{--                </label>--}}
            </div>


            <div class="form-buttons">
                <div class="register-now-button btn">
                    <a href="{{route('register')}}">
                        <h6>Regjistrohu tani!</h6>
                    </a>
                </div>
                <button class="login-now-button btn">
                    <h6>Kyçu</h6>
                </button>
            </div>

        </form>
    </div>
    </div>

</div>
@endsection
