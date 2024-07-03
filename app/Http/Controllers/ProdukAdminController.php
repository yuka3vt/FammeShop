<?php

namespace App\Http\Controllers;

use App\Jobs\diskonInfoJob;
use App\Jobs\newProdukJob;
use App\Models\Blog;
use App\Models\Produk;
use App\Models\Produkkategori;
use App\Models\Produkukuran;
use App\Models\Produkwarna;
use Illuminate\Http\Request;
use DOMDocument;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProdukAdminController extends Controller
{
    public function indexProduk()
    {   
        return view('users.admin.produk.produkView', [
            'judul' => 'Produk',
            'h1' => 'Produk View',

            'produk' => Produk::with('produkukuran','produkwarna','produkkategori')
            ->orderBy('updated_at', 'desc')
            ->get(),
        ]);
    }
    public function tambahViewProduk()
    {
        return view('users.admin.produk.produkAdd', [
            'judul' => 'Produk',
            'h1' => 'Produk Tambah',
            'produkKategori' => Produkkategori::all(),
            'produkWarna' => Produkwarna::all(),
            'produkUkuran' => Produkukuran::all(),
        ]);
    }
    public function tambahProduk(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|unique:produks',
            'deskripsi' => 'required|string',
        ]);
       
        $harga = str_replace('.', '', $request->harga);
        $slug = Str::slug($request->nama, '-');
        $produk = new Produk();
        if ($request->file('image')) {
            $imagePath = $request->file('image')->store('public/produk');

            $imageFullPath = storage_path("app/$imagePath");
            

            $produk->image = str_replace('public/', '', $imagePath);
        }
        $dimensi = $request->dimensi;
        $produk->nama = $request->nama;
        $produk->slug = $slug;
        $produk->bahan = $request->bahan;
        $produk->berat = $request->berat;
        $produk->dimensi = $dimensi;
        $produk->stok = $request->stok;
        $produk->harga = (int) $harga;
        $produk->diskon = $request->diskon;
        $produk->hargaTotal = (int) $harga -((int) $harga * $request->diskon / 100);
        $produk->deskripsi = $request->deskripsi;
        $produk->save();
        if ($request->has('kategori')) {
            $produk->produkkategori()->sync($request->kategori);
        }
        if ($request->has('warna')) {
            $produk->produkwarna()->sync($request->warna);
        }
        if ($request->has('ukuran')) {
            $produk->produkukuran()->sync($request->ukuran);
        }
        dispatch(new newProdukJob($slug));
        return redirect('/admin/produk-view')->with('sukses', 'Produk telah ditambahkan!');
    }
    public function editViewProduk(Produk $produk)
    {
        return view('users.admin.produk.produkEdit', [
            'judul' => 'Produk',
            'h1' => 'Produk Edit',
            'produk' => $produk,
            'selectedCategories' => $produk->produkkategori->pluck('id')->toArray(),
            'produkKategori' => Produkkategori::all(),
            'selectedWarnas' => $produk->produkwarna->pluck('id')->toArray(),
            'produkWarna' => Produkwarna::all(),
            'selectedUkurans' => $produk->produkukuran->pluck('id')->toArray(),
            'produkUkuran' => Produkukuran::all(),
        ]);
    }
    public function editProduk(Produk $produk, Request $request){
        $produk = Produk::find($produk->id);
        if (!$produk) {
            return redirect()->back()->with('gagal', 'Produk tidak ditemukan.');
        }
        $slug = Str::slug($request->input('nama'), '-');
        $harga = str_replace('.', '', $request->harga);
        if ($request->file('image')) {
            Storage::delete('public/' . $produk->image);
            $imagePath = $request->file('image')->store('public/produk');
            $imageFullPath = storage_path("app/$imagePath");
            $produk->image = str_replace('public/', '', $imagePath);
        }
        $dimensi = $request->dimensi;
        $produk->nama = $request->nama;
        $produk->slug = $slug;
        $produk->bahan = $request->bahan;
        $produk->berat = $request->berat;
        $produk->dimensi = $dimensi;
        $produk->stok = $request->stok;
        $produk->harga = (int) $harga;
        $produk->diskon = $request->diskon;
        $produk->hargaTotal = (int) $harga -((int) $harga * $request->diskon / 100);
        $produk->deskripsi = $request->deskripsi;
        $produk->save();
        if ($request->has('kategori')) {
            $produk->produkkategori()->sync($request->kategori);
        }
        if ($request->has('warna')) {
            $produk->produkwarna()->sync($request->warna);
        }
        if ($request->has('ukuran')) {
            $produk->produkukuran()->sync($request->ukuran);
        }
        return redirect('/admin/produk-view')->with('sukses', 'Produk berhasil diperbarui.');
    }
    public function hapusProduk(Request $request)
    {
        $produk = Produk::find($request->input('ID'));
        if ($produk) {
            Storage::delete('public/' . $produk->image);
            $produk->delete();
            return back()->with('sukses','Produk berhasil di hapus');
        }
        return back()->with('gagal','Produk gagal di hapus');
    }
    
    public function indexKategori()
    {
        return view('users.admin.produk.produkKategoriView', [
            'judul' => 'Produk Kategori',
            'h1' => 'Produk Kategori View',
            'produkKategori' => Produkkategori::all(),
        ]);
    }
    public function tambahViewKategori()
    {
        return view('users.admin.produk.produkKategoriAdd', [
            'judul' => 'Produk Kategori',
            'h1' => 'Kategori Produk Tambah',
        ]);
    }
    public function tambahKategori(Request $request)
    {
        $request->validate([
            'nama' => 'required|unique:produkkategoris', 
            'slug' => 'required|unique:produkkategoris',
        ], [
            'nama.unique' => 'Kategori produk sudah ada.', 
            'slug.unique' => 'Slug kategori sudah ada.',
        ]); 
        $kategori = new Produkkategori();
        $kategori->nama = $request->input('nama');
        $kategori->slug = $request->input('slug');
        $kategori->save();
        return redirect('/admin/produk-kategori-view')->with('sukses','Kategori produk berhasil di tambahkan');
    }
    public function editViewKategori(Produkkategori $produkkategori)
    {
        return view('users.admin.produk.produkKategoriEdit', [
            'judul' => 'Produk Kategori',
            'h1' => 'Kategori Produk Edit',
            'produkKategori' => $produkkategori
        ]);
    }
    public function editKategori(Produkkategori $produkkategori, Request $request){
        $kategori = Produkkategori::find($produkkategori->id);
        if (!$kategori) {
            return redirect()->back()->with('gagal', 'Kategori tidak ditemukan.');
        }
        $kategori->nama = $request->input('nama');
        $kategori->slug = $request->input('slug');
        $kategori->save();
        return redirect('/admin/produk-kategori-view')->with('sukses', 'Kategori berhasil diperbarui.');
    }
    public function hapusKategori(Request $request)
    {
        $kategori = Produkkategori::find($request->input('ID'));
        if ($kategori) {
            $kategori->delete();
            return back()->with('sukses','Kategori produk berhasil di hapus');
        }
        return back()->with('gagal','Kategori produk gagal di hapus');
    }

    public function indexWarna()
    {
        return view('users.admin.produk.produkWarnaView', [
            'judul' => 'Produk Variasi',
            'h1' => 'Produk Warna View',
            'produkWarna' => Produkwarna::all(),
        ]);
    }
    public function indexUkuran()
    {
        return view('users.admin.produk.produkUkuranView', [
            'judul' => 'Produk Variasi',
            'h1' => 'Produk Ukuran View',
            'produkUkuran' => Produkukuran::all(),
        ]);
    }
    public function tambahViewWarna()
    {
        return view('users.admin.produk.produkWarnaAdd', [
            'judul' => 'Produk Variasi',
            'h1' => 'Warna Produk Tambah',
        ]);
    }
    public function tambahViewUkuran()
    {
        return view('users.admin.produk.produkUkuranAdd', [
            'judul' => 'Produk Variasi',
            'h1' => 'Ukuran Produk Tambah',
        ]);
    }
    public function tambahWarna(Request $request)
    {
        $request->validate([
            'nama' => 'required|unique:produkwarnas', 
            'slug' => 'required|unique:produkwarnas',
        ], [
            'nama.unique' => 'Warna produk sudah ada.', 
            'slug.unique' => 'Slug Warna sudah ada.',
        ]); 
        $warna = new Produkwarna();
        $warna->nama = $request->input('nama');
        $warna->slug = $request->input('slug');
        $warna->save();
        return redirect('/admin/produk-warna-view')->with('sukses','Warna produk berhasil di tambahkan');
    }
    public function tambahUkuran(Request $request)
    {
        $request->validate([
            'nama' => 'required|unique:produkukurans', 
            'slug' => 'required|unique:produkukurans',
        ], [
            'nama.unique' => 'Ukuran produk sudah ada.', 
            'slug.unique' => 'Slug Ukuran sudah ada.',
        ]); 
        $ukuran = new Produkukuran();
        $ukuran->nama = $request->input('nama');
        $ukuran->slug = $request->input('slug');
        $ukuran->save();
        return redirect('/admin/produk-ukuran-view')->with('sukses','Ukuran produk berhasil di tambahkan');
    }
    public function editViewWarna(Produkwarna $produkwarna)
    {
        return view('users.admin.produk.produkWarnaEdit', [
            'judul' => 'Produk Variasi',
            'h1' => 'Warna Produk Edit',
            'produkWarna' => $produkwarna
        ]);
    }
    public function editViewUkuran(Produkukuran $produkukuran)
    {
        return view('users.admin.produk.produkUkuranEdit', [
            'judul' => 'Produk Variasi',
            'h1' => 'Ukuran Produk Edit',
            'produkUkuran' => $produkukuran
        ]);
    }
    public function editWarna(Produkwarna $produkwarna, Request $request){
        $warna = Produkwarna::find($produkwarna->id);
        if (!$warna) {
            return redirect()->back()->with('gagal', 'Warna tidak ditemukan.');
        }
        $warna->nama = $request->input('nama');
        $warna->slug = $request->input('slug');
        $warna->save();
        return redirect('/admin/produk-warna-view')->with('sukses', 'Warna berhasil diperbarui.');
    }
    public function editUkuran(Produkukuran $produkukuran, Request $request){
        $ukuran = Produkukuran::find($produkukuran->id);
        if (!$ukuran) {
            return redirect()->back()->with('gagal', 'ukuran tidak ditemukan.');
        }
        $ukuran->nama = $request->input('nama');
        $ukuran->slug = $request->input('slug');
        $ukuran->save();
        return redirect('/admin/produk-ukuran-view')->with('sukses', 'Ukuran berhasil diperbarui.');
    }
    public function hapusWarna(Request $request)
    {
        $warna = Produkwarna::find($request->input('ID'));
        if ($warna) {
            $warna->delete();
            return back()->with('sukses','Warna produk berhasil di hapus');
        }
        return back()->with('gagal','Warna produk gagal di hapus');
    }
    public function hapusUkuran(Request $request)
    {
        $ukuran = Produkukuran::find($request->input('ID'));
        if ($ukuran) {
            $ukuran->delete();
            return back()->with('sukses','Ukuran produk berhasil di hapus');
        }
        return back()->with('gagal','Warna Ukuran gagal di hapus');
    }
    public function diskon(Request $request){
        if ($request->diskon==0) {
            $produk = Produk::find($request->idProduk);
            $produk->diskon = null;
            $produk->hargaTotal = $produk->harga;
            $produk->save();
        }else{
            $produk = Produk::find($request->idProduk);
            $diskon =$request->diskon;
            $harga = $produk->harga;
            $hargaTotal = $harga -($harga*$diskon/100);
            $produk->diskon = $diskon;
            $produk->hargaTotal = $hargaTotal;
            $produk->save();
            dispatch(new diskonInfoJob($diskon, $produk->nama, $harga, $hargaTotal));
        }
        return redirect('/admin/produk-view')->with('sukses', 'Diskon berhasil diubah.');
    }
    public function linkStorage(){
        Artisan::call('storage:link');
        return back()->with('sukses', 'Link berhasil dilakukan');
    }
}