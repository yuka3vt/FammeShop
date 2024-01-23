<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class newOrder extends Mailable
{
    use Queueable, SerializesModels;

    private $status;
    private $nomorPesan;
    private $nama;
    private $metode;
    private $waktuPesan;
    private $alamat;
    private $level;
    /**
     * Create a new message instance.
     */
    public function __construct($status, $nomorPesan, $nama, $metode, $waktuPesan, $alamat, $level)
    {
        $this->status = $status;
        $this->nomorPesan = $nomorPesan;
        $this->nama = $nama;
        $this->metode = $metode;
        $this->waktuPesan = $waktuPesan;
        $this->alamat = $alamat;
        $this->level = $level;
    }


    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Pesanan '.  $this->status,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'email.newOrder',
        );
    }

    public function build()
    {
        return $this->subject('Pesanan '.$this->status)
            ->view('email.otp')
            ->with('status', $this->status)
            ->with('nomorPesan', $this->nomorPesan)
            ->with('nama', $this->nama)
            ->with('metode', $this->metode)
            ->with('waktuPesan', $this->waktuPesan)
            ->with('alamat', $this->alamat)
            ->with('level', $this->level);
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
