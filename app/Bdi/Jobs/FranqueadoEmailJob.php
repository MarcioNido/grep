<?php

namespace App\Bdi\Jobs;

use App\Mail\ContatoFranqueadoEmail;
use App\Site\ContatoFranqueado;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class FranqueadoEmailJob implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    protected $contato;

    /**
     * Create a new job instance.
     * @param ContatoFranqueado $contato
     */
    public function __construct(ContatoFranqueado $contato)
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
        $dest = 'site@leardi.com.br';
        Mail::to($dest)->send(new ContatoFranqueadoEmail($this->contato));
    }
}
