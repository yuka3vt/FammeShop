<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Produkkategori;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function show(Produk $produk)
    {
        return view('users.user.produk.produkDetail',[
            'judul' => 'Produk',
            'produks' => $produk
        ]);
    }
}
