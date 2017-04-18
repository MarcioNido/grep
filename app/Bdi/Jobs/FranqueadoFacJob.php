<?php

namespace App\Bdi\Jobs;

use App\Bdi\ExpCliente;
use App\Site\ContatoFranqueado;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

/**
 * Class ContatoMaisInformacoesEmailJob
 * Will send the e-mail to the agency about a new contact
 * Triggered by the App\Bdi\Observers\ContatoObserver class
 *
 * @package App\Bdi\Jobs
 */
class FranqueadoFacJob implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    protected $contato;

    /**
     * Create a new job instance.
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
        $fac = new ExpCliente();
        $fac->datahora = date('Y-m-d H:i:s');
        $fac->atualizacao = date('Y-m-d H:i:s');
        $fac->tipofac_id = 17;
        $fac->profissional1_id = 4334;
        $fac->nome = $this->contato->nome;
        $fac->ddd1 = $this->contato->ddd;
        $fac->telefone1 = $this->contato->telefone;
        $fac->email = $this->contato->email;
        $fac->situacao = 'ATIVO';
        $fac->estagio = 'CADASTRO RECEBIDO';
        $fac->prioridade = 'ALTA';
        $fac->obs = $this->contato->mensagem;
        $fac->saveOrFail();
    }


}
