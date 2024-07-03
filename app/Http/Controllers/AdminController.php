<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Keranjang;
use App\Models\Pesanan;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Kavist\RajaOngkir\Facades\RajaOngkir;

class AdminController extends Controller
{
    public function index()
    {
        $subtotal = 0;
        $selesai = Keranjang::where('status', 'selesai')
            ->with('pesanan')
            ->get();
        foreach ($selesai as $keranjang) {
            $subtotal += $keranjang->subtotal;
        }
        return view('users.admin.dashboard', [
            'judul' => 'Dashboard',
            'h1' => 'Dashboard',
            'blog' => Blog::all(),
            'user' => User::where('level', 'pengguna'),
            'order' => Keranjang::where('status', 'dikemas')
            ->get(),
            'pendapatan' => $subtotal,

        ]);
    }
    public function daftarUser()
    {
        return view('users.admin.user', [
            'judul' => 'Daftar User',
            'h1' => 'Daftar User',
            'dataUser' => User::where('level', 'pengguna')->get()
        ]);
    }
    public function profil()
    {
        $daftarProvinsi = RajaOngkir::provinsi()->all();
        $dataUser = User::where('id', auth()->user()->id)->first();
        $dataUser->created_at_formatted = Carbon::parse($dataUser->tanggal_lahir)->format('d-m-Y');
        if ($dataUser->provinsi && $dataUser->kota) {
            $dataAlamat = RajaOngkir::kota()->dariProvinsi($dataUser->provinsi)->find($dataUser->kota);
            $alamat = $dataAlamat['province'].', '.$dataAlamat['city_name'].', '. $dataUser->kecamatan .'('.$dataUser->kode_pos.') ,'.$dataUser->detail_alamat;
        } else {
            $alamat = '-';
        }
        
        return view('users.admin.profil', [
            'judul' => 'Profil',
            'h1' => 'Data Saya',
            'dataUser' => $dataUser,
            'provinsi' => $daftarProvinsi,
            'alamat' => $alamat
        ]);
    }
    public function hapusUser(User $user)
    {
        $cekUser = User::where('username', $user->username)->first();
        if ($cekUser) {
            $cekUser->delete();
            return back()->with('sukses','User berhasil di hapus');
        }
        return back()->with('gagal','User gagal di hapus');
    }
    public function cekBuktiBayar(Request $request, Pesanan $pesanan){
        $pesanan->status = 'Sudah dibayar';
        $pesanan->save();
        $dataPesanan = Pesanan::where('no_pesanan', $pesanan->no_pesanan)
            ->with('keranjang')
            ->first();
        foreach ($dataPesanan->keranjang as $keranjang) {
            Keranjang::where('id', $keranjang->id)->update(['status' => 'dikemas']);
        }
        return redirect('/admin/pesanan/?status=dikemas')->with('sukses', 'Pesanan '.$pesanan->no_pesanan.' diterima');
    }
}
