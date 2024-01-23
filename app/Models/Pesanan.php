<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function keranjang()
    {
        return $this->belongsToMany(Keranjang::class,'pesanan_keranjang');
    }
    public function scopeFilter($query, array $filters){
        $query->when($filters['status'] ?? false, function ($query, $status) {
            $query->whereHas('keranjang', function ($query) use ($status) {
                $query->where('status', $status);
            });
        });
    }
}
