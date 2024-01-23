<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function produkukuran(){
        return $this->belongsToMany(Produkukuran::class,'produk_produkukuran');
    }
    public function produkwarna(){
        return $this->belongsToMany(Produkwarna::class,'produk_produkwarna');
    }
    public function produkkategori()
    {
        return $this->belongsToMany(Produkkategori::class,'produk_produkkategori');
    }
    public function scopeFilter($query, array $filters){
        $query->when($filters['search'] ?? false, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->where('judul', 'like', '%' . $search . '%')
                    ->orWhere('isi_blog', 'like', '%' . $search . '%');
            });
        });
        $query->when($filters['kategori'] ?? false, function ($query, $kategori) {
            $query->whereHas('produkkategori', function ($query) use ($kategori) {
                $query->where('slug', $kategori);
            });
        });
    }
}
