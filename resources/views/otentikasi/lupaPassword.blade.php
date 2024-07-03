@extends('otentikasi.index')
@section('konten')
<div class="limiter">
    <div class="container-login100">
        <div class="wrap-login100">
             @if (session()->has('berhasil'))
                <div class="floating-notification">
                    {{ session('berhasil')}}
                </div>
            @endif
            <form class="login100-form validate-form" action="/lupa-password" method="POST">
                @csrf
                <span class="login100-form-title p-b-26">
                    {{ __('Reset Password') }}
                </span>
                <span class="login100-form-title p-b-48">
                </span>
                <div class="wrap-input100 validate-input" data-validate="Email perlu di Isi" style="margin-bottom: 0;">
                    <input class="input100" type="text" name="email" data-validate="email" placeholder="Email" value="{{ old('email') }}" required autocomplete="email">
                </div>
                <p style="margin-top: 0px" class="small text-danger">&nbsp; @error('email'){{ $message }}@enderror</p>
                <div class="container-login100-form-btn m-t-40">
                    <div class="wrap-login100-form-btn">
                        <div class="login100-form-bgbtn"></div>
                        <button class="login100-form-btn" type="submit">
                            {{ __('Send Password Reset Link') }}
                        </button>
                    </div>
                </div>
                <div class="text-center">
                    <span class="txt1">
                        Berubah pikiran?
                    </span>
                    <a class="txt2" href="/login">
                        Login
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
<div id="dropDownSelect1"></div>
@endsection