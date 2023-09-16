@extends('otentikasi.index')
@section('konten')
<div class="limiter">
    <div class="container-login100">
        <div class="wrap-login100">
            <form class="login100-form validate-form" action="/register" method="POST">
                @csrf
                <span class="login100-form-title p-b-26">
                    Sign Up
                </span>
                <span class="login100-form-title p-b-48">
                </span>

                <div class="wrap-input100 validate-input" data-validate="Nama perlu di Isi" style="margin-bottom: 0;">
                    <input autofocus class="input100 " type="text" name="nama"  placeholder="Nama" value="{{ old('nama') }}">
                </div>
                <p style="margin-top: 0px" class="small text-danger"> &nbsp; @error('nama'){{ $message }}@enderror</p>

                <div class="wrap-input100 validate-input" data-validate="Username perlu di Isi" style="margin-bottom: 0;">
                    <input autofocus class="input100" type="text" name="username" data-validate = "username" placeholder="Username" value="{{ old('username') }}" pattern="[a-zA-Z0-9_]+" title="Username harus terdiri dari huruf, angka, atau karakter garis bawah, dan tidak boleh mengandung spasi.">
                </div>
                <p style="margin-top: 0px" class="small text-danger">&nbsp; @error('username'){{ $message }}@enderror</p>
                
                <div class="wrap-input100 validate-input" data-validate="Telepon perlu di Isi" style="margin-bottom: 0;">
                    <input autofocus class="input100" type="text" name="telepon" data-validate="telepon" placeholder="Telepon" value="{{ old('telepon') }}" >
                </div>
                <p style="margin-top: 0px" class="small text-danger">&nbsp; @error('telepon'){{ $message }}@enderror</p>
                
                <div class="wrap-input100 validate-input" data-validate="Email perlu di Isi" style="margin-bottom: 0;">
                    <input autofocus class="input100" type="text" name="email" data-validate="email" placeholder="Email" value="{{ old('email') }}">
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
    
                <div class="container-login100-form-btn m-t-40">
                    <div class="wrap-login100-form-btn">
                        <div class="login100-form-bgbtn"></div>
                        <button class="login100-form-btn" type="submit">
                            Daftar
                        </button>
                    </div>
                </div>
                
                <div class="text-center p-t-5">
                    <span class="txt1">
                        Sudah punya akun?
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