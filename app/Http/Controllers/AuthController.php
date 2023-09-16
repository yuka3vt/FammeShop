<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


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
            $data['nama'] = "Femme Shop";
            $data['username'] = $data['name'];
            $data['telepon'] = "085752056623";
            $data['email'] = "femmeshop@gmail.com";
            $data['password'] = "12345678";
            $data['password'] = bcrypt($data['password']);
            User::create($data);
            return redirect('/login');
        }
    }
    public function register()
    {
        return view('otentikasi.register', [
            'judul' => 'Register'
        ]);
    }

    public function RegisterStore(Request $request){
        $datas = $request->validate([
            'nama' => 'required',
            'username' => 'required|unique:users',
            'telepon' => 'required|unique:users',
            'email' => 'required|unique:users|email:dns',
            'password' => 'required|min:8|max:20|same:password_confirmation', 
        ]);
        $datas['password'] = bcrypt($datas['password']);
        User::create($datas);

        return redirect('/login')->with('berhasil','Register berhasil silahkan login');
    }

    public function Autentikasi(Request $request)
    {
        $datas = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);
        if (Auth::attempt($datas)) {
            $request->session()->regenerate();
            if(Auth::user()->level==="pengguna"){
                return redirect()->intended('/shop');
            }else{
                return redirect()->intended('/dashboard');     
            }
        }

        return back()->with('gagalLogin', 'Username atau Password anda salah!');
    }

    public function logout(Request $request){
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
