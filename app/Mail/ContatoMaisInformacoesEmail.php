<?php

namespace App\Mail;

use App\Site\Contato;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContatoMaisInformacoesEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var Contato $contato
     */
    public $contato;

    /**
     * Create a new message instance.
     *
     * @param Contato $contato
     */
    public function __construct(Contato $contato)
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
        return $this->view('site.emails.contato');
    }
}
