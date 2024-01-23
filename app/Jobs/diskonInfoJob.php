<?php

namespace App\Jobs;

use App\Mail\diskonInfo;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class diskonInfoJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $diskon;
    private $produk;
    private $harga;
    private $hargaTotal;
    /**
     * Create a new job instance.
     */
    public function __construct($diskon, $produk, $harga, $hargaTotal)
    {
        $this->diskon = $diskon;
        $this->produk = $produk;
        $this->harga = $harga;
        $this->hargaTotal = $hargaTotal;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $emailUsers = User::where('level', 'pengguna')->where('akun', 'aktif')->get();
        foreach ($emailUsers as $user) {
            $mail = new diskonInfo($this->diskon, $user->nama, $this->produk, $this->harga, $this->hargaTotal);
            Mail::to($user->email)->queue($mail);
        }
    }
}
