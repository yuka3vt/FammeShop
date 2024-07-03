<?php

namespace App\Http\Controllers;

use App\Jobs\SendMailJob;
use App\Jobs\WelcomeJob;
use App\Mail\OtpEmail;
use App\Models\User;
use App\Models\VerificationCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;


class AuthController extends Controller
{
    public function login()
    {
        $jum =0;
        $User = User::all();
        foreach($User as $user){
            if($user->level ==="admin"){
                $jum++;
            }
        }
        if ($jum>0){
            return view('otentikasi.login', [
                'judul' => 'Login'
            ]);
        }
        else{
            $data['level'] = "admin";
            $data['akun'] = "aktif";
            $data['nama'] = "Admin";
            $data['jenis_kelamin'] = "Laki-Laki";
            $data['tempat_lahir'] = "Sanggau Ledo";
            $data['tanggal_lahir'] = "2021-03-21";
            $data['username'] = 'onlyone';
            $data['telepon'] = "085752056623";
            $data['email'] = "admin@gmail.com";
            $data['password'] = "12345678";
            $data['password'] = bcrypt($data['password']);
            User::create($data);
            
            return redirect('/login');
        }
    }
    public function Autentikasi(Request $request){
        $datas = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);
        $datas['akun'] = 'aktif';
        if (Auth::attempt($datas)) {
            $request->session()->regenerate();
            if (auth()->user()->level === 'admin') {
                return redirect()->intended('/admin/dashboard');
            }else{
                return redirect()->intended('/');
            }
        }
        return back()->with('gagalLogin', 'Email atau Password anda salah!');
    }
    public function register()
    {
        return view('otentikasi.register', [
            'judul' => 'Register'
        ]);
    }
    public function RegisterStore(Request $request){
        $dataUser = User::where('email', $request->email)
            ->first();
        if ($dataUser !== null) {
            if ($dataUser->akun === "aktif") {
                $datas = $request->validate([
                    'nama' => 'required',
                    'username' => 'required|unique:users',
                    'telepon' => 'required|unique:users',
                    'email' => 'required|unique:users|email:dns',
                    'password' => 'required|min:8|max:20|same:password_confirmation', 
                ]);
            }else {
                $dataUser->delete();
                $datas = $request->validate([
                    'nama' => 'required',
                    'username' => 'required|unique:users',
                    'telepon' => 'required|unique:users',
                    'email' => 'required|unique:users|email:dns',
                    'password' => 'required|min:8|max:20|same:password_confirmation', 
                ]);  
                $datas['password'] = bcrypt($datas['password']);
                User::create($datas);
                $this->kirim_otp($request->email);
                $request->session()->put('otp_in_progress', true);
                $encryptedUser = Crypt::encrypt($request->email);
                $url = '/register/otp?user=' . $encryptedUser;
                return redirect($url);
            }
        }else{
            $datas = $request->validate([
                'nama' => 'required',
                'username' => 'required|unique:users',
                'telepon' => 'required|unique:users',
                'email' => 'required|unique:users|email:dns',
                'password' => 'required|min:8|max:20|same:password_confirmation', 
            ]);
            $datas['password'] = bcrypt($datas['password']);
            User::create($datas);
            $this->kirim_otp($request->email);
            $request->session()->put('otp_in_progress', true);
            $encryptedUser = Crypt::encrypt($request->email);
            $url = '/register/otp?user=' . $encryptedUser;
            return redirect($url);
        }
    }
    public function logout(Request $request){
        Auth::logout();
        $request->session()->forget('checkout_in_progress');
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function otpView(Request $request){
        if ($request->session()->has('otp_in_progress')) {
            $encryptedUser = $request->query('user');
            try {
                if (empty($encryptedUser)) {
                    return redirect('/register');
                }
                $email = Crypt::decrypt($encryptedUser);
                return view('otentikasi.otp', [
                    'judul' => 'OTP Verifikasi',
                    'mail' => $email
                ]);
            } catch (DecryptException $e) {
                return redirect('/register');
            }
        }
        return redirect('/register');
    }
    

    public function cekOtp(Request $request){
        $email = $request->email;
        $otpInput = $request->numb1 . $request->numb2 . $request->numb3 . $request->numb4;
        $verification = VerificationCode::where('email', $email)
            ->first();
        $otp = $verification->kode;
        if ($otp===$otpInput) {
            if (!$verification->isExpired()) {
                $user = User::where('email', $email)->first();
                $user->akun = 'aktif';
                $user->save();
                $data = [
                    'email' => $email,
                    'nama' => $user->nama, 
                ];
                dispatch(new WelcomeJob($data));
                $verification->delete();
                $request->session()->forget('otp_in_progress');
                return redirect('/login')->with('berhasil', 'Registrasi akun berhasil');
            } else {
                return back()->with('errorOtp', 'OTP kamu expired');
            }
        } else {
            return back()->with('errorOtp', 'OTP kamu tidak valid');
        }
    }
    public function kirim_otp($email){
        $otp = $this->generateOTP();
        $data = [
            'email' => $email,
            'otp' => $otp, 
        ];
        VerificationCode::updateOrCreate(
            ['email' => $email],
            ['kode' => $otp] 
        );
        dispatch(new SendMailJob($data));
    }
    public function kirim_ulang_otp($verificationcode, Request $request) {
        if ($request->session()->has('otp_in_progress')) {
            if (filter_var($verificationcode, FILTER_VALIDATE_EMAIL)) {
                $this->kirim_otp($verificationcode);
                return back();
            } else {
                return back();
            }
        }
        return redirect('/register');
    }
    public function generateOTP(){
        $otp = rand(1000, 9999);
        return $otp;
    }

    public function lupaPassword(){
        return view('otentikasi.lupaPassword', [
            'judul' => 'Lupa Paassword',
        ]);
    }
}
