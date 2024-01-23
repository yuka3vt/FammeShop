<?php

namespace App\Http\Controllers;

use App\Models\Keranjang;
use App\Models\Produk;
use App\Models\Produkkategori;
use App\Models\User;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ProdukController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        return view('users.user.produk.produk', [
            'judul' => 'Shop',
            'footer' => 'ya',
            'dataKategori' => Produkkategori::all(),
            'dataProduk' => Produk::orderBy('diskon', 'desc')
            ->orderBy('dibeli', 'desc')
            ->orderBy('suka', 'desc')
            ->orderBy('updated_at', 'desc')
            ->filter(request(['search','kategori']))
            ->paginate(20)
            ->withQueryString(),
            'dataKeranjang' => Keranjang::orderBy('updated_at', 'desc')
            ->with('produk')
            ->where('user_id', $user->id)
            ->where('status', 'keranjang')
            ->get(),

            'dataSuka' => Wishlist::orderBy('updated_at', 'desc')
            ->where('user_id',  $user->id)
            ->get(),
        ]);
    }
    public function show(Produk $produk, Request $request)
    {
        $request->session()->forget('wishlist');
        return view('users.user.produk.produkDetail',[
            'judul' => 'Shop',
            'footer' => 'ya',
            'dataProduk' => $produk,
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
}
