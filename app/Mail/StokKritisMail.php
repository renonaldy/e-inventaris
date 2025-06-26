<?php

namespace App\Mail;

use App\Models\Barang;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class StokKritisMail extends Mailable
{
    use Queueable, SerializesModels;

    public $barang;
    /**
     * Create a new message instance.
     */
    public function __construct(Barang $barang)
    {
        //
        $this->barang = $barang;
    }

    public function build()
    {
        return $this->subject('Peringatan: Stok Barang Kritis')
            ->view('emails.stok-kritis');
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Stok Kritis Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'view.name',
        );
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
