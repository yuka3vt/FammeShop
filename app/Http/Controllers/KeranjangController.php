<?php

namespace App\Http\Controllers;

use App\Models\Keranjang;
use App\Models\Produk;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class KeranjangController extends Controller
{
    public function index($username)
    {
        if ($username!==auth()->user()->username) {
            return redirect('/keranjang/'.auth()->user()->username);
        }
        return view('users.user.keranjang',[
            'judul' => 'Keranjang',
            'footer' => 'tidak',
            'dataKeranjang' => Keranjang::orderBy('updated_at', 'desc')
            ->with('produk')
            ->where('user_id', auth()->user()->id)
            ->where('status', 'keranjang')
            ->get(),
            'dataSuka' => Wishlist::orderBy('updated_at', 'desc')
            ->where('user_id', auth()->user()->id)
            ->get(),
        ]);
    }
    public function keranjangModal(Produk $produk, Request $request)
    {
        $request->session()->forget('wishlist');
        $request->session()->put('cartModal', true);
        return view('users.user.produk.produkTambahKeKeranjang',[
            'judul' => 'Add Cart',
            'footer' => 'tidak',
            'produks' => $produk,
            'dataSuka' => Wishlist::orderBy('updated_at', 'desc')
                ->where('user_id', auth()->user()->id)
                ->get(),
        ]);
    }
    public function tambahKeKeranjang(Request $request)
    {
        $userId = auth()->user()->id;
        $produkId = $request->input('produkId');
        $jumlah = $request->input('jumlah');
        $harga = $request->input('harga');
        $subtotal = $jumlah * $harga;
        $ukuran = $request->input('ukuran');
        $warna = $request->input('warna');
        $existingItem = Keranjang::where('user_id', $userId)
            ->where('produk_id', $produkId)
            ->where('status', 'keranjang')
            ->where('ukuran', $ukuran)
            ->where('warna', $warna)
            ->first();
        if ($existingItem) {
            $existingItem->jumlah += $jumlah;
            $existingItem->subtotal += $subtotal;
            $existingItem->save();
        } else {
            $datas = [
                'user_id' => $userId,
                'produk_id' => $produkId,
                'status' => 'keranjang',
                'ukuran' => $ukuran,
                'warna' => $warna,
                'jumlah' => $jumlah,
                'subtotal' => $subtotal,
            ];
            Keranjang::create($datas);
        }
        if ($request->session()->has('cartModal')) {
            $request->session()->forget('cartModal');
            return redirect('/shop');
        }
        $request->session()->forget('cartModal');
        return back();
    }
    public function updateDeleteKeranjang(Request $request){
        if ($request->has('update')) {
            $keranjangItemUpdate = $request->input('keranjangIdUpdate', []);
            $jumlahItems = $request->input('num-product1', []);
            foreach ($keranjangItemUpdate as $idUpdate) {
                if (array_key_exists($idUpdate, $jumlahItems)) {
                    $jumlah = $jumlahItems[$idUpdate];
                    $keranjang = Keranjang::find($idUpdate);
                    $keranjang->jumlah = $jumlah;
                    $keranjang->subtotal = $jumlah * $keranjang->produk->hargaTotal;
                    $keranjang->save();
                }
            }
            return back();
        } elseif ($request->has('hapus')) {
            $keranjangItems = $request->input('keranjangId', []);
            foreach ($keranjangItems as $id) {
                $keranjang = Keranjang::find($id);
                if ($keranjang) {
                    $keranjang->delete();
                }
            }
            return back();
        }elseif($request->has('cekout')){
            $keranjangItems = $request->input('keranjangId', []);
            if (empty($keranjangItems)) {
                return back();
            }
            $request->session()->put('checkout_in_progress', true);
            $keranjangIds = implode(',', $keranjangItems);
            $encryptedKeranjangIds = Crypt::encrypt($keranjangIds);
            $url = '/keranjang/proses-pesanan?produk=' . $encryptedKeranjangIds;
            return redirect($url);
        }
    }
}