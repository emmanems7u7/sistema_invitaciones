<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class InvitacionConfirmacionMail extends Mailable
{
    use Queueable, SerializesModels;

    public $invitado;
    public $invitacion;

    /**
     * Create a new message instance.
     */
    public function __construct($invitado, $invitacion)
    {
        $this->invitado = $invitado;
        $this->invitacion = $invitacion;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Confirmación de asistencia al evento',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.enviar_invitacion', // Asegúrate que esta vista existe
            with: [
                'invitado' => $this->invitado,
                'invitacion' => $this->invitacion,
            ],
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
