<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $with = ['produkkategori','produkukuran','produkwarna'];

    public function produkukuran(){
        return $this->belongsTo(Produkukuran::class);
    }
    public function produkwarna(){
        return $this->belongsTo(Produkwarna::class);
    }
    public function produkkategori()
    {
        return $this->belongsToMany(Produkkategori::class,'produk_produkkategori');
    }
}
