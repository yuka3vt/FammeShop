<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    public function index()
    {
        return view('base.home', [
            'judul' => 'Femme Shop',
            'blog' => Blog::take(3)->orderBy('updated_at', 'desc')->get()
        ]);
    }
    
    public function tentang()
    {
        return view('base.tentang', [
            'judul' => 'Tentang'
        ]);
    }
    public function hubungi()
    {
        return view('base.hubungi', [
            'judul' => 'Hubungi'
        ]);
    }
}
