<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Blog extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $with = ['blogkategori','user'];

    public function user(){
        return $this->belongsTo(User::class);
    }
    
    public function blogkategori()
    {
        return $this->belongsToMany(Blogkategori::class,'blog_blogkategori');
    }

    public function scopeFilter($query, array $filters){
        $query->when($filters['search'] ?? false, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->where('judul', 'like', '%' . $search . '%')
                    ->orWhere('isi_blog', 'like', '%' . $search . '%');
            });
        });
    
        $query->when($filters['kategori'] ?? false, function ($query, $kategori) {
            $query->whereHas('blogkategori', function ($query) use ($kategori) {
                $query->where('slug', $kategori);
            });
        });
    }
}
