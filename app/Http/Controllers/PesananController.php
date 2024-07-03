<?php

namespace App\Http\Controllers;

use App\Jobs\newOrderJob;
use App\Mail\newOrder;
use App\Models\Keranjang;
use App\Models\Pesanan;
use App\Models\Produk;
use App\Models\User;
use App\Models\Wishlist;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;
use Kavist\RajaOngkir\Facades\RajaOngkir;

class PesananController extends Controller
{
    public function index($username,Request $request)
    {
        if ($username!==auth()->user()->username) {
            return redirect('/pesanan/'.auth()->user()->username);
        }
        $user = auth()->user();
        if ($request->path() == "pesanan/$user->username" && !$request->has('status')) {
            $request->merge(['status' => 'bayar']);
        }
        return view('users.user.pesanan', [
            'judul' => 'Pesanan',
            'footer' => 'tidak',
            'dataKeranjang' => Keranjang::orderBy('updated_at', 'desc')
            ->with('produk')
            ->where('user_id', $user->id)
            ->where('status', 'keranjang')
            ->get(),
            'dataPesanan' => Pesanan::orderBy('updated_at', 'desc')
                ->with('keranjang','keranjang.produk')
                ->where('user_id', $user->id)
                ->filter(request(['search','status']))
                ->get(),
            'dataSuka' => Wishlist::orderBy('updated_at', 'desc')
            ->where('user_id',  $user->id)
            ->get(),
        ]);
    }
    public function show($username, $no_pesanan){
        if ($username!==auth()->user()->username) {
            return redirect('/pesanan/'.auth()->user()->username.'/'.$no_pesanan);
        }
        $detailPesanan = Pesanan::orderBy('updated_at', 'desc')
            ->with('keranjang', 'keranjang.produk')
            ->where('user_id', auth()->user()->id)
            ->where('no_pesanan', $no_pesanan)
            ->first();
        $detailPesanan->created_at_formatted = Carbon::parse($detailPesanan->created_at)->format('d-m-Y H:i');
        return view('users.user.pesananDetail', [
            'judul' => 'Pesanan',
            'footer' => 'tidak',
            'dataKeranjang' => Keranjang::orderBy('updated_at', 'desc')
            ->with('produk','user')
            ->where('user_id', auth()->user()->id)
            ->where('status', 'keranjang')
            ->get(),
            'detailPesanan' => $detailPesanan,
            'dataSuka' => Wishlist::orderBy('updated_at', 'desc')
            ->where('user_id',  auth()->user()->id)
            ->get(),
        ]);
    }
    public function prosesPesanan(Request $request){
        $user = Auth::user();
        if (empty($user->provinsi) || empty($user->kota) || empty($user->kecamatan) || empty($user->kode_pos) || empty($user->detail_alamat)) {
            return redirect('/profil/' . $user->username)->with('error','Alamat kamu masih kosong');
        }
        $encryptedKeranjangIds = $request->query('produk');
        try {
            $keranjangIds = explode(',', Crypt::decrypt($encryptedKeranjangIds));
        } catch (\Exception $e) {
            return back();
        }if (empty($keranjangIds)) {return back();}
        $dataKeranjang = Keranjang::orderBy('updated_at', 'desc')
            ->with('produk')
            ->where('user_id', auth()->user()->id)
            ->where('status', 'keranjang')
            ->whereIn('id', $keranjangIds)
            ->get();

        $totalBerat = $dataKeranjang->reduce(function ($carry, $item) {
            if ($item->produk && isset($item->produk->berat)) {
                $carry += $item->produk->berat;
            }
            return $carry;
        }, 0);
        if ($totalBerat==0) {
            $totalBerat=1;
        }

        $dataAlamat = RajaOngkir::kota()->dariProvinsi($user->provinsi)->find($user->kota);
        $alamat = $dataAlamat['province'].', '.$dataAlamat['city_name'].', '. $user->kecamatan .'('.$user->kode_pos.') ,'.$user->detail_alamat;
        $data = RajaOngkir::ongkosKirim([
            'origin'=> 365,
            'destination'=> $user->kota,
            'weight'=> $totalBerat,
            'courier'=> 'jne'])->get();
        return view('users.user.cekout',[
            'judul' => 'Proses Pesanan',
            'footer' => 'tidak',
            'dataUser' => $user,
            'layanan' => $data,
            'pesananProduk' => $dataKeranjang,
            'alamat' => $alamat
        ]);
    }
    public function cekOutPesanan(Request $request){
        $no_pesan = $this->buatNoPesanan();
        $user = Auth::user();
        $admin = User::where('level','admin')->first();
        $keranjangIds = $request->input('keranjangId', []);
        $pesanan = Pesanan::create([
            'user_id' => $user->id,
            'pembayaran' => $request->input('pembayaran'),
            'alamat' => $request->input('alamat'),
            'pengiriman' => $request->input('pengiriman'),
            'subtotal' => $request->input('subtotal'),
            'kurir' => $request->input('kurir'),
            'layanan' => $request->input('layanan'),
            'no_pesanan' => $no_pesan,
        ]);
        $pesanan->keranjang()->attach($keranjangIds);
        dispatch(new newOrderJob('Masuk', $user->nama,$request->input('pembayaran'), $no_pesan, now(), $request->input('alamat'), $admin->email, $admin->level));
        dispatch(new newOrderJob('Dibuat', $user->nama,$request->input('pembayaran'), $no_pesan, now(), $request->input('alamat'), $user->email, $user->level));
        if ($request->input('pembayaran')!=='COD') {
            Keranjang::whereIn('id', $keranjangIds)->update(['status' => 'bayar']);
        }else{
            Keranjang::whereIn('id', $keranjangIds)->update(['status' => 'dikemas']);
        }
        $request->session()->forget('checkout_in_progress');
        $dataProduk = Keranjang::where('status','dikemas')
        ->with('produk')
        ->get();
        foreach ($dataProduk as $item) {
            $newStok = $item->produk->stok - $item->jumlah;
            if ($newStok<0) {
                return redirect('/keranjang/'. auth()->user()->username);
            }else{
                Produk::where('id', $item->produk_id)->update(['stok' => $newStok]);
            }
        }
        return redirect('/pesanan/'. auth()->user()->username);
    }
    function buatNoPesanan() {
        do {
            $tahun = substr(now()->format('Y'), -2);
            $waktu = now()->format('mdH');
            $str = Str::random(6);
            $noPesan = $tahun . $waktu . $str;
            $cekData = Pesanan::where('no_pesanan', $noPesan)->first();
        } while ($cekData);
        return $noPesan;
    }
    public function batalkanPesanan (Pesanan $pesanan){
        $dataPesanan = Pesanan::where('no_pesanan', $pesanan->no_pesanan)
            ->with('keranjang')
            ->first();
        $user = User::where('id', $pesanan->user_id)->first();   
        $admin = User::where('level','admin')->first();
        foreach ($dataPesanan->keranjang as $keranjang) {
            Keranjang::where('id', $keranjang->id)->update(['status' => 'dibatalkan']);
        }
        $dataProduk = Keranjang::where('status','dibatalkan')
        ->with('produk')
        ->get();
        dispatch(new newOrderJob('Dibatalkan ', $user->nama, $dataPesanan->pembayaran, $pesanan->no_pesanan, now(), $pesanan->alamat, $user->email, $user->level));
        dispatch(new newOrderJob('Batal ', $user->nama, $dataPesanan->pembayaran, $pesanan->no_pesanan, now(), $pesanan->alamat, $admin->email, $admin->level));
        foreach ($dataProduk as $item) {
            $newStok = $item->produk->stok + $item->jumlah;
            Produk::where('id', $item->produk_id)->update(['stok' => $newStok]);
        }
        if (auth()->user()->level==="admin") {
            return redirect('/admin/pesanan?status=dibatalkan'); 
        }
        return redirect('/pesanan/'. auth()->user()->username.'?status=dibatalkan'); 
    }
    public function kirimPesanan (Pesanan $pesanan){
        $dataPesanan = Pesanan::where('no_pesanan', $pesanan->no_pesanan)
            ->with('keranjang')
            ->first();
        $user = User::where('id', $pesanan->user_id)->first();
        foreach ($dataPesanan->keranjang as $keranjang) {
            Keranjang::where('id', $keranjang->id)->update(['status' => 'dikirim']);
        }
        dispatch(new newOrderJob('Dikirim', $user->nama, $dataPesanan->pembayaran, $pesanan->no_pesanan, now(), $pesanan->alamat, $user->email, $user->level));
        if (auth()->user()->level==="admin") {
            return redirect('/admin/pesanan?status=dikirim'); 
        }
        return redirect('/pesanan/'. auth()->user()->username.'?status=dikirim'); 
    }
    public function selesaiPesanan (Pesanan $pesanan){
        $dataPesanan = Pesanan::where('no_pesanan', $pesanan->no_pesanan)
            ->with('keranjang', 'keranjang.produk')
            ->first();
        $user = User::where('id', $pesanan->user_id)->first();   
        $admin = User::where('level','admin')->first();
        foreach ($dataPesanan->keranjang as $keranjang) {
            dispatch(new newOrderJob('Selesai ', $user->nama, $dataPesanan->pembayaran, $pesanan->no_pesanan, now(), $pesanan->alamat, $user->email, $user->level));
            dispatch(new newOrderJob('Selesai ', $user->nama, $dataPesanan->pembayaran, $pesanan->no_pesanan, now(), $pesanan->alamat, $admin->email, $admin->level));
            Keranjang::where('id', $keranjang->id)->update(['status' => 'selesai']);
            $beli = $keranjang->produk->dibeli;
            $keranjang->produk->dibeli = $beli+1;
            $keranjang->produk->save();
        }
        if (auth()->user()->level==="admin") {
            return redirect('/admin/pesanan?status=selesai'); 
        }
        return redirect('/pesanan/'. auth()->user()->username.'?status=selesai'); 
    }
}