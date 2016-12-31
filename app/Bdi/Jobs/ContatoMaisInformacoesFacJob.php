<?php

namespace App\Bdi\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Site\Contato;

/**
 * Class ContatoMaisInformacoesEmailJob
 * Will send the e-mail to the agency about a new contact
 * Triggered by the App\Bdi\Observers\ContatoObserver class
 *
 * @package App\Bdi\Jobs
 */
class ContatoMaisInformacoesFacJob implements ShouldQueue
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
        // cria uma fac em pré-atendimento na agência responsável
    }
}
