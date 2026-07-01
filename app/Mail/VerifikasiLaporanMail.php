<?php

namespace App\Mail;

use App\Models\Laporan;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class VerifikasiLaporanMail extends Mailable
{
    use Queueable, SerializesModels;

    public $laporan;
    public $urlVerifikasi;

    public function __construct(Laporan $laporan, $urlVerifikasi)
    {
        $this->laporan = $laporan;
        $this->urlVerifikasi = $urlVerifikasi;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Verifikasi Laporan Warga - Desa Gunturmadu',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.verifikasi-laporan', // Kita akan buat file blade ini
        );
    }
}