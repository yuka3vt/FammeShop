<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Keranjang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use App\Http\Controllers\ProdukController;
use App\Models\Produk;
use App\Models\Wishlist;

class BaseController extends Controller
{
    
    public function index()
    {
        if (Auth::check()) {
            return view('base.home', [
                'judul' => 'Femme Shop',

                'blog' => Blog::with('user')->take(3)
                ->orderBy('updated_at', 'desc')
                ->get(),
                
                'dataKeranjang' => Keranjang::orderBy('updated_at', 'desc')
                ->with('produk')
                ->where('user_id', auth()->user()->id)
                ->where('status', 'keranjang')
                ->get(),

                'dataKeranjang' => Keranjang::orderBy('updated_at', 'desc')
                ->with('produk')
                ->where('user_id', auth()->user()->id)
                ->where('status', 'keranjang')
                ->get(),

                'dataSuka' => Wishlist::orderBy('updated_at', 'desc')
                ->where('user_id', auth()->user()->id)
                ->get(),

                'banyakDisuka' => Produk::orderBy('suka', 'desc')
                ->take(4)
                ->get(),

                'banyakDibeli' => Produk::orderBy('dibeli', 'desc')
                ->take(4)
                ->get(),

                'produkBaru' => Produk::orderBy('updated_at', 'desc')
                ->take(4)
                ->get(),
            ]);
        }else{
            return view('base.home', [
                'judul' => 'Femme Shop',
                'blog' => Blog::with('user')->take(3)
                ->orderBy('updated_at', 'desc')
                ->get(),
            
                'banyakDisuka' => Produk::orderBy('suka', 'desc')
                ->take(4)
                ->get(),

                'banyakDibeli' => Produk::orderBy('dibeli', 'desc')
                ->take(4)
                ->get(),

                'produkBaru' => Produk::orderBy('updated_at', 'desc')
                ->take(4)
                ->get(),
            ]);
        }
    }
    
    public function tentang()
    {
        if (Auth::check()) {
            return view('base.tentang', [
                'judul' => 'Tentang',

                'dataKeranjang' => Keranjang::orderBy('updated_at', 'desc')
                ->with('produk')
                ->where('user_id', auth()->user()->id)
                ->where('status', 'keranjang')
                ->get(),

                'dataSuka' => Wishlist::orderBy('updated_at', 'desc')
                ->where('user_id', auth()->user()->id)
                ->get(),
            ]);
        }else{
            return view('base.tentang', [
                'judul' => 'Tentang',
            ]);
        }
    }
    public function hubungi()
    {
        if (Auth::check()) {
            return view('base.hubungi', [
                'judul' => 'Hubungi',

                'dataKeranjang' => Keranjang::orderBy('updated_at', 'desc')
                ->with('produk')
                ->where('user_id', auth()->user()->id)
                ->where('status', 'keranjang')
                ->get(),

                'dataSuka' => Wishlist::orderBy('updated_at', 'desc')
                ->where('user_id', auth()->user()->id)
                ->get(),
            ]);
        }else{
            return view('base.hubungi', [
                'judul' => 'Hubungi',
            ]);
        }
    }
}
