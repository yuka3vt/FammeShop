<?php

namespace App\Jobs;

use App\Mail\newProduk;
use App\Models\Produk;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class newProdukJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $slug;
    /**
     * Create a new job instance.
     */
    public function __construct($slug)
    {
        $this->slug = $slug;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $produk = Produk::where('slug', $this->slug)->first();
        if (!$produk) {
            Log::error('Produk dengan slug ' . $this->slug . ' tidak ditemukan.');
            return;
        }
        $emailUsers = User::where('level', 'pengguna')->where('akun', 'aktif')->get();
        foreach ($emailUsers as $user) {
            $mail = new NewProduk($user->nama, $produk->nama, $produk->harga);
            Mail::to($user->email)->queue($mail);
        }
    }
}
