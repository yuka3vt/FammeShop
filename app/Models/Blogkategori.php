<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Blogkategori extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function blog()
    {
        return $this->belongsToMany(Blog::class, 'blog_blogkategori', 'blogkategori_id', 'blog_id');
    }
}
