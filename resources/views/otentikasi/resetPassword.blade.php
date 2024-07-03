@extends('otentikasi.index')
@section('konten')
<div class="limiter">
    <div class="container-login100">
        <div class="wrap-login100">
            <form class="login100-form validate-form" action="/reset-password" method="POST">
                @csrf
                <span class="login100-form-title p-b-26">
                    Update Password
                </span>
                <span class="login100-form-title p-b-48">
                </span>
                <div class="wrap-input100 validate-input" data-validate="Email perlu di Isi" style="margin-bottom: 0;">
                    <input class="input100" type="text" name="email" data-validate="email" placeholder="Email" value="{{ $email }}" readonly>
                </div>
                <p style="margin-top: 0px" class="small text-danger">&nbsp; @error('email'){{ $message }}@enderror</p>
                <div class="wrap-input100 validate-input" data-validate="Password perlu di Isi" style="margin-bottom: 0;">
                    <span class="btn-show-pass">
                        <i class="zmdi zmdi-eye"></i>
                    </span>
                    <input class="input100" type="password" name="password" placeholder="Password">
                </div>
                <p style="margin-top: 0px" class="small text-danger">&nbsp;@error('password'){{ $message }}@enderror</p>
                <div class="wrap-input100 validate-input" data-validate="Password perlu di Isi" style="margin-bottom: 0;">
                    <span class="btn-show-pass">
                        <i class="zmdi zmdi-eye"></i>
                    </span>
                    <input class="input100" type="password" name="password_confirmation" placeholder="Ulangi Password">
                </div>
                <p style="margin-top: 0px" class="small text-danger">&nbsp;@error('password'){{ $message }}@enderror</p>
                <input type="hidden" name="email" value="{{ $email }}">
                <input type="hidden" name="token" value="{{ $token }}">
                <div class="container-login100-form-btn m-t-40">
                    <div class="wrap-login100-form-btn">
                        <div class="login100-form-bgbtn"></div>
                        <button class="login100-form-btn" type="submit">
                            Update Password
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