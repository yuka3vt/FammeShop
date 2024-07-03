<?php

namespace App\Http\Controllers;

use App\Models\Keranjang;
use App\Models\Pesanan;
use App\Models\Produk;
use App\Models\Produkkategori;
use App\Models\User;
use App\Models\Wishlist;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use Kavist\RajaOngkir\Facades\RajaOngkir;

class UserController extends Controller
{
    public function index($username){
        $user = Auth::user();
        if ($username!==auth()->user()->username) {
            return redirect('/profil/'.auth()->user()->username);
        }
        $daftarProvinsi = RajaOngkir::provinsi()->all();
        $user->created_at_formatted = Carbon::parse($user->tanggal_lahir)->format('d-m-Y');
        if ($user->provinsi && $user->kota) {
            $dataAlamat = RajaOngkir::kota()->dariProvinsi($user->provinsi)->find($user->kota);
            $alamat = $dataAlamat['province'].', '.$dataAlamat['city_name'].', '. $user->kecamatan .'('.$user->kode_pos.') ,'.$user->detail_alamat;
        } else {
            $alamat = '-';
        }
        return view('users.user.profil',[
            'judul' => 'Profil',
            'footer' => 'tidak',
            'dataKeranjang' => Keranjang::orderBy('updated_at', 'desc')
                ->with('produk')
                ->where('user_id', auth()->user()->id)
                ->where('status', 'keranjang')
                ->get(),
            'dataUser' => $user,
            'provinsi' => $daftarProvinsi,
            'dataSuka' => Wishlist::orderBy('updated_at', 'desc')
                ->where('user_id', auth()->user()->id)
                ->get(),
            'alamat' => $alamat   
        ]);
    }
    public function updateAlamat(Request $request, $username){
        $validatedData = $request->validate([
            'provinsi' => 'required|string',
            'kota' => 'required|string',
            'kecamatan' => 'required|string',
            'kode_pos' => 'required|string',
            'detail_alamat' => 'required|string',
        ]);

        User::where('username', auth()->user()->username)->update($validatedData);
        if (auth()->user()->level==="admin") {
            return redirect('/admin/profil')->with('success', 'Address updated successfully');
        }

        return redirect('/profil/'.auth()->user()->username)->with('success', 'Address updated successfully');
    }
    public function updateProfile(Request $request, $username){
        $user = User::where('username', $username)->firstOrFail();
        $validatedData = $request->validate([
            'image' => 'image|file|max:5024',
            'nama' => 'required|string',
            'jenis_kelamin' => 'required|in:Laki-Laki,Perempuan',
            'telepon' => 'required|string',
            'tempat_lahir' => 'required|string',
            'tanggal_lahir' => 'required|date',
        ]);
        if ($request->file('image')) {
            Storage::delete('public/' . $user->image);
            $imagePath = $request->file('image')->store('public/profil-user');
            $validatedData['image'] = str_replace('public/', '', $imagePath);
        }
        $user->update([
            'nama' => $validatedData['nama'],
            'jenis_kelamin' => $validatedData['jenis_kelamin'],
            'telepon' => $validatedData['telepon'],
            'tempat_lahir' => $validatedData['tempat_lahir'],
            'tanggal_lahir' => $validatedData['tanggal_lahir'],
            'image' => $validatedData['image'] ?? $user->image,
        ]);
        if (auth()->user()->level==="admin") {
            return redirect('/admin/profil')->with('success', 'Profil updated successfully');
        }
        return redirect('/profil/'.$username)->with('success', 'Profil updated successfully');
    }
    public function uploadBuktiBayar(Request $request, Pesanan $pesanan){
        if ($request->file('image')) {
            Storage::delete('public/' . $pesanan->image);
            $imagePath = $request->file('image')->store('public/bukti-bayar');
            $validatedData['image'] = str_replace('public/', '', $imagePath);
        }
        $pesanan->update([
            'image' => $validatedData['image'] ?? $pesanan->image,
        ]);
        return redirect('/pesanan/'. auth()->user()->username)->with('success', 'Update berhasil');
    }
}
