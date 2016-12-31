<?php

namespace App\Bdi\Jobs;

use App\Mail\ContatoMaisInformacoesEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Site\Contato;
use Illuminate\Support\Facades\Mail;

class ContatoMaisInformacoesEmailJob implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    protected $contato;

    /**
     * Create a new job instance.
     */
    public function __construct(Contato $contato)
    {
        $this->contato = $contato;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $dest = $this->contato->agencia->email;
        if ($dest == null || $dest == '') {
            $dest = 'marcio.nido@leardi.com.br';
        }
        // @TODO: remove this
        $dest = 'marcio.nido@leardi.com.br';

        Mail::to($dest)->send(new ContatoMaisInformacoesEmail($this->contato));
    }
}
