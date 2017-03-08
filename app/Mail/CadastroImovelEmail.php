<?php

namespace App\Mail;

use App\Site\CadImovel;
use App\Site\Contato;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Http\Components\CHtml;

class CadastroImovelEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var CadImovel $cadImovel
     */
    public $cadImovel;

    /**
     * Create a new message instance.
     *
     * @param CadImovel $cadImovel
     */
    public function __construct(CadImovel $cadImovel)
    {
        $this->cadImovel = $cadImovel;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('site.emails.cad-imovel');
    }
}
