<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Jobs\resetPasswordJob;
use App\Models\User;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Carbon\Carbon;

class ResetPasswordController extends Controller
{
    public function index(Request $request) {
        if ($request->has('token') && $request->has('email')) {
            $user = User::where('email', $request->email)->first();
            if ($user && $request->token===$user->reset_token) {
                $updatedAt = Carbon::parse($user->updated_at);
                if ($updatedAt->diffInMinutes(now()) <= 60) {
                    return view('otentikasi.resetPassword', [
                        'judul' => 'Reset Password',
                        'token' => $request->token,
                        'email' => $request->email,
                    ]);
                } else {
                    return redirect('/lupa-password')->with('gagalLogin','Sesion kamu sudah habis');
                }
            } else {
                return redirect('/');
            }
        } else {
            return redirect('/');
        }
    }
    

    public function sendResetToken(Request $request){
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return redirect()->back()->withErrors(['email' => 'User not found']);
        }
        $token = Password::createToken($user);
        $user->update(['reset_token' => $token]);
        dispatch(new resetPasswordJob($token,$user->nama,$user->email));
        return redirect()->back()->with('berhasil', 'Email berhasil dikirim, silahkan buka email');
    }

    public function updatePassword(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'token' => 'required',
            'password' => 'required|min:8|max:20|same:password_confirmation',
        ]);

        $user = User::where('email', $request->email)->first();
        if (!$user || $request->token !== $user->reset_token) {
            return redirect('/');
        }
        $user->update(['reset_token' => null]);
        $user->update(['password' => Hash::make($request->password)]);
        return redirect('/login')->with('berhasil', 'Password berhasil diupdate silahkan login!');
    }
}
