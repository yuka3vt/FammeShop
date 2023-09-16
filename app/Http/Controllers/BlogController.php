<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Blogkategori;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        return view('base.blog.blog', [
            'judul' => 'Blog',
            'blogs' => Blog::orderBy('updated_at', 'desc')->filter(request(['search','kategori']))->paginate(3)->withQueryString(),
            'kategoris' => Blogkategori::all()
        ]);
    }


    public function show(Blog $blog)
    {
        return view('base.blog.blogDetail',[
            'judul' => 'Blog',
            'blogs' => $blog,
            'kategoris'=>Blogkategori::all()
        ]);
    }
}
