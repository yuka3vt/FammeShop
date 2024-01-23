<?php

namespace App\Http\Controllers;

use App\Models\Keranjang;
use App\Models\Produk;
use App\Models\User;
use App\Models\Wishlist;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function index($username,Request $request)
    {
        if ($username!==auth()->user()->username) {
            return redirect('/wishlist/'.auth()->user()->username);
        }
        $request->session()->put('wishlist', true);
        return view('users.user.wishlist',[
            'judul' => 'Wishlist',
            'footer' => 'tidak',

            'dataKeranjang' => Keranjang::orderBy('updated_at', 'desc')
            ->with('produk')
            ->where('user_id', auth()->user()->id)
            ->where('status', 'keranjang')
            ->get(),
            
            'dataSuka' => Wishlist::orderBy('updated_at', 'desc')
            ->with('produk')
            ->where('user_id', auth()->user()->id)
            ->paginate(20),
        ]);
    }

    public function hapusWishlist(Produk $produk, Request $request){
        $user = auth()->user();
        $itemDiWishlist = Wishlist::where('user_id', $user->id)
        ->where('produk_id', $produk->id)
        ->first();
        if ($itemDiWishlist) {
            $itemDiWishlist->delete();
            $suka = $produk->suka;
            if ($suka!==0) {
                $produk->suka = $suka-1;
                $produk->save();
            }
            if ($request->session()->has('wishlist')) {
                $request->session()->forget('wishlist');
                return redirect('/wishlist/'.$user->username)->with('berhasil', 'Item ditambahkan');
            }
            $request->session()->forget('wishlist');
            return back();
        }
        $request->session()->forget('wishlist');
        return back();
    }

    public function tambahWishlist(Produk $produk){
        $userId = auth()->user()->id;
        $produkId = $produk->id;
        $existingItem = Wishlist::where('user_id', $userId)
        ->where('produk_id', $produkId)
        ->first();
        if (!$existingItem) {
            Wishlist::create(['produk_id' => $produkId, 'user_id' => $userId]);
            $suka = $produk->suka;
            $produk->suka = $suka+1;
            $produk->save();
            return back()->with('success', 'Produk telah ditambahkan ke Wishlist');
        } else {
            return back()->with('error', 'Produk sudah ada di Wishlist');
        }
    }
}
