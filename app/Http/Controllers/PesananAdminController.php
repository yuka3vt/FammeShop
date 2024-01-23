<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use Illuminate\Http\Request;

class PesananAdminController extends Controller
{
    public function index(Request $request)
    {
        if ($request->path() == "admin/pesanan" && !$request->has('status')) {
            $request->merge(['status' => 'bayar']);
        }
        return view('users.admin.pesanan', [
            'judul' => 'Pesanan',
            'h1' => 'Pesanan',
            'dataPesanan' => Pesanan::orderBy('updated_at', 'desc')
            ->with('keranjang','keranjang.produk','user')
            ->filter(request(['search','status']))
            ->get(),
        ]);
    }
}
