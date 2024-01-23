<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Blogkategori;
use App\Models\Keranjang;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProdukController;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Cache;

class BlogController extends Controller
{
    protected function getBlogKategoris()
{
    $cacheKey = 'blog_kategoris';
    return Cache::remember($cacheKey, now()->addMinutes(10), function () {
        return Blogkategori::all();
    });
}

    public function index()
    {
        if (Auth::check()) {
            return view('base.blog.blog', [
                'judul' => 'Blog', 
                'kategoris' => $this->getBlogKategoris(),
                'dataBlog' => Blog::with('blogkategori','user')
                    ->orderBy('updated_at', 'desc')
                    ->filter(request(['search','kategori']))
                    ->paginate(3)
                    ->withQueryString(),
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
            return view('base.blog.blog', [
                'judul' => 'Blog', 
                'kategoris' => Blogkategori::all(),
                'dataBlog' => Blog::with('blogkategori','user')
                    ->orderBy('updated_at', 'desc')
                    ->filter(request(['search','kategori']))
                    ->paginate(3)
                    ->withQueryString(),
            ]);
        }
    }
    public function show(Blog $blog)
    {
        if (Auth::check()) {
            return view('base.blog.blogDetail',[
                'judul' => 'Blog',
                'dataBlog' => $blog,
                'kategoris'=>$this->getBlogKategoris(),             
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
            return view('base.blog.blogDetail',[
                'judul' => 'Blog',
                'dataBlog' => $blog,
                'kategoris'=> $this->getBlogKategoris(),
            ]);
        }
    }
}
