<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class diskonInfo extends Mailable
{
    use Queueable, SerializesModels;

    private $diskon;
    private $nama;
    private $produk;
    private $harga;
    private $hargaTotal;
    /**
     * Create a new message instance.
     */
    public function __construct($diskon, $nama, $produk, $harga, $hargaTotal)
    {
        $this->diskon = $diskon;
        $this->nama = $nama;
        $this->produk = $produk;
        $this->harga = $harga;
        $this->hargaTotal = $hargaTotal;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Produk Diskon',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'email.diskon',
        );
    }
    public function build()
    {
        return $this->subject('Produk Diskon')
            ->view('email.diskon')
            ->with('diskon', $this->diskon)
            ->with('nama', $this->nama)
            ->with('produk', $this->produk)
            ->with('harga', $this->harga)
            ->with('hargaTotal', $this->hargaTotal);
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
