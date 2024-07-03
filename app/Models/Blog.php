<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Blog extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function blogkategori()
    {
        return $this->belongsToMany(Blogkategori::class,'blog_blogkategori');
    }
    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $keywords = explode(' ', $search);
                foreach ($keywords as $keyword) {
                    $query->orWhere('judul', 'like', '%' . $keyword . '%')
                        ->orWhere('isi_blog', 'like', '%' . $keyword . '%');
                }
            });
        });

        $query->when($filters['kategori'] ?? false, function ($query, $kategori) {
            $query->whereHas('blogkategori', function ($query) use ($kategori) {
                $query->where('slug', $kategori);
            });
        });
    }
    public function searchableColumns()
    {
        return ['judul','isi_blog'];
    }
}
