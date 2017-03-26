<?php

namespace App\Bdi\Jobs;

use App\Bdi\FacBdi;
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
        $fac = new FacBdi();
        $fac->agencia_id = $this->contato->agencia_id;
        $fac->dh_criacao = date('Y-m-d H:i:s');
        $fac->dh_pre_cadastro = date('Y-m-d H:i:s');
        $fac->profissional_pre_cadastro_id = 2654; // HOMOLOGAÇÃO 2991
        $fac->cli_nome = $this->contato->nome;
        $fac->cli_ddd1 = $this->contato->ddd;
        $fac->cli_telefone1 = $this->contato->telefone;
        $fac->cli_email = $this->contato->email;
        $fac->imovel_id = $this->contato->imovel_id;
        $fac->referencias = $this->contato->imovel_id;
        $fac->codtipofac = 7;
        $fac->obs = $this->contato->mensagem;
        $fac->saveOrFail();
    }
}
