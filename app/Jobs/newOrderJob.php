<?php

namespace App\Jobs;

use App\Mail\newOrder;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class newOrderJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $status;
    private $nama;
    private $metode;
    private $nomorPesan;
    private $waktuPesan;
    private $alamat;
    private $email;
    private $level;
    /**
     * Create a new job instance.
     */
    public function __construct($status, $nama, $metode, $nomorPesan, $waktuPesan, $alamat, $email, $level)
    {
        $this->status = $status;
        $this->nama = $nama;
        $this->metode = $metode;
        $this->nomorPesan = $nomorPesan;
        $this->waktuPesan = $waktuPesan;
        $this->alamat = $alamat;
        $this->email = $email;
        $this->level = $level;
    }
    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $mail = new newOrder($this->status, $this->nomorPesan, $this->nama, $this->metode, $this->waktuPesan, $this->alamat, $this->level);
        Mail::to($this->email)->send($mail);
    }
}
