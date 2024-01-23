<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Support\Str;
use App\Models\Blogkategori;
use Illuminate\Http\Request;
use DOMDocument;
use Illuminate\Support\Facades\Storage;

class BlogAdminController extends Controller
{
    public function indexBlog()
    {
        return view('users.admin.blog.blogView', [
            'judul' => 'Blog',
            'h1' => 'Blog View',
            'blog' => Blog::with('blogkategori','user')
            ->orderBy('updated_at', 'desc')
            ->get(),
        ]);
    }
    public function tambahViewBlog()
    {
        return view('users.admin.blog.blogAdd', [
            'judul' => 'Blog',
            'h1' => 'Blog Tambah',
            'blogKategori' => Blogkategori::all()
        ]);
    }
    public function tambahBlog(Request $request)
    {
        $validatedData = $request->validate([
            'judul' => 'required|string',
            'isi_blog' => 'required|string',
        ]);
        $konten = $request->isi_blog;
        $dom = new DOMDocument();
        $dom->loadHTML($konten);
        $paragrafs = $dom->getElementsByTagName('p');
        $kutipan = '';
        foreach ($paragrafs as $p) {
            $teks = $p->textContent;
            $kutipan .= ' ' . $teks;
            if (str_word_count($kutipan) >= 20) {
                break;
            }
        }
        $kutipan = implode(' ', array_slice(str_word_count($kutipan, 1), 0, 20));
        $slug = Str::slug($request->judul, '-');
        $blog = new Blog();
        if ($request->file('image')) {
            $imagePath = $request->file('image')->store('public/blog');
            $blog->image = str_replace('public/', '', $imagePath);
        }
        $blog->user_id = auth()->user()->id;
        $blog->judul = $request->judul;
        $blog->slug = $slug;
        $blog->kutipan = $kutipan;
        $blog->isi_blog = $request->isi_blog;
        $blog->save();
        if ($request->has('kategori')) {
            $blog->blogkategori()->sync($request->kategori);
        }
        return redirect('/admin/blog-view')->with('sukses', 'Blog telah ditambahkan!');
    }
    public function editViewBlog(Blog $blog)
    {
        return view('users.admin.blog.blogEdit', [
            'judul' => 'Blog',
            'h1' => 'Blog Edit',
            'blog' => $blog,
            'selectedCategories' => $blog->blogkategori->pluck('id')->toArray(),
            'blogKategori' => Blogkategori::all()
        ]);
    }
    public function editBlog(Blog $blog, Request $request){
        $blog = Blog::find($blog->id);
        if (!$blog) {
            return redirect()->back()->with('gagal', 'Blog tidak ditemukan.');
        }
        $konten = $request->input('isi_blog');
        $dom = new DOMDocument();
        $dom->loadHTML($konten);
        $paragrafs = $dom->getElementsByTagName('p');
        $kutipan = '';
        foreach ($paragrafs as $p) {
            $teks = $p->textContent;
            $kutipan .= ' ' . $teks;
            if (str_word_count($kutipan) >= 20) {
                break;
            }
        }
        $kutipan = implode(' ', array_slice(str_word_count($kutipan, 1), 0, 20));
        $slug = Str::slug($request->input('judul'), '-');
        if ($request->file('image')) {
            Storage::delete('public/' . $blog->image);
            $imagePath = $request->file('image')->store('public/blog');
            $blog->image = str_replace('public/', '', $imagePath);
        }
        $blog->user_id = auth()->user()->id;
        $blog->judul = $request->judul;
        $blog->slug = $slug;
        $blog->kutipan = $kutipan;
        $blog->isi_blog = $request->isi_blog;
        $blog->save();
        if ($request->has('kategori')) {
            $blog->blogkategori()->sync($request->kategori);
        }
        return redirect('/admin/blog-view')->with('sukses', 'Blog berhasil diperbarui.');
    }
    public function hapusBlog(Request $request)
    {
        $blog = Blog::find($request->input('ID'));
        if ($blog) {
            Storage::delete('public/' . $blog->image);
            $blog->delete();
            return back()->with('sukses','Kategori blog berhasil di hapus');
        }
        return back()->with('gagal','Kategori blog gagal di hapus');
    }


    public function indexKategori()
    {
        return view('users.admin.blog.blogKategoriView', [
            'judul' => 'Blog Kategori',
            'h1' => 'Kategori Blog View',
            'blogKategori' => Blogkategori::all()
        ]);
    }
    public function tambahViewKategori()
    {
        return view('users.admin.blog.blogKategoriAdd', [
            'judul' => 'Blog Kategori',
            'h1' => 'Kategori Blog Tambah',
        ]);
    }
    public function tambahKategori(Request $request)
    {
        $request->validate([
            'nama' => 'required|unique:blogkategoris', 
            'slug' => 'required|unique:blogkategoris',
        ], [
            'nama.unique' => 'Kategori blog sudah ada.', 
            'slug.unique' => 'Slug kategori sudah ada.',
        ]); 
        $kategori = new BlogKategori();
        $kategori->nama = $request->input('nama');
        $kategori->slug = $request->input('slug');
        $kategori->save();
        return redirect('/admin/blog-kategori-view')->with('sukses','Kategori blog berhasil di tambahkan');
    }
    public function editViewKategori(Blogkategori $blogkategori)
    {
        return view('users.admin.blog.blogKategoriEdit', [
            'judul' => 'Blog Kategori',
            'h1' => 'Kategori Blog Edit',
            'blogKategori' => $blogkategori
        ]);
    }
    public function editKategori(Blogkategori $blogkategori, Request $request){
        $kategori = BlogKategori::find($blogkategori->id);
        if (!$kategori) {
            return redirect()->back()->with('gagal', 'Kategori tidak ditemukan.');
        }
        $kategori->nama = $request->input('nama');
        $kategori->slug = $request->input('slug');
        $kategori->save();
        return redirect('/admin/blog-kategori-view')->with('sukses', 'Kategori berhasil diperbarui.');
    }
    public function hapusKategori(Request $request)
    {
        $kategori = Blogkategori::find($request->input('ID'));
        if ($kategori) {
            $kategori->delete();
            return back()->with('sukses','Kategori blog berhasil di hapus');
        }
        return back()->with('gagal','Kategori blog gagal di hapus');
    }
}
