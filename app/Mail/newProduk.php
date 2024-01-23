<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class newProduk extends Mailable
{
    use Queueable, SerializesModels;

    private $nama;
    private $image;
    private $produk;
    /**
     * Create a new message instance.
     */
    public function __construct($nama, $image, $produk)
    {
       $this->nama = $nama;
       $this->image = $image;
       $this->produk = $produk;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New Produk',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'email.newProduk',
        );
    }
    public function build()
    {
        $imagePath = $this->image === 'default' ? public_path('defaultProduk.png') : storage_path('app/public/' . $this->image);
        $imageEmbed = $this->embed($imagePath);
        return $this->subject('New Produk')
                    ->view('email.newProduk')
                    ->with([
                        'nama' => $this->nama,
                        'namaProduk' => $this->produk,
                    ])
                    ->attach($imagePath, [
                        'as' => 'nama_file_gambar.png', 
                        'mime' => 'image/png',
                    ]);
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
