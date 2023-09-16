<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Produkkategori;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return view('users.user.produk.produk', [
            'judul' => 'Shop',
            'produks' => Produk::all(),
            'kategoris' => Produkkategori::all()
        ]);
    }
}
