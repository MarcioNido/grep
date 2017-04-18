<?php

namespace App\Mail;

use App\Site\ContatoFranqueado;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContatoFranqueadoEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var Contato $contato
     */
    public $contato;

    /**
     * Create a new message instance.
     *
     * @param ContatoFranqueado $contato
     */
    public function __construct(ContatoFranqueado $contato)
    {
        $this->contato = $contato;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('site.emails.contato-franqueado');
    }
}
