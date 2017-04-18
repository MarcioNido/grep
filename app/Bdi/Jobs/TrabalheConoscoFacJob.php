<?php

namespace App\Bdi\Jobs;

use App\Bdi\ExpCliente;
use App\Bdi\ProspeccaoProfissional;
use App\Site\ContatoFranqueado;
use App\Site\TrabalheConosco;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

/**
 * Class TrabalheConoscoFacJob
 * Will send the e-mail to the agency about a new contact
 * Triggered by the App\Bdi\Observers\TrabalheConoscoObserver class
 *
 * @package App\Bdi\Jobs
 */
class TrabalheConoscoFacJob implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    protected $contato;

    /**
     * Create a new job instance.
     */
    public function __construct(TrabalheConosco $contato)
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
        $fac = new ProspeccaoProfissional();
        $fac->estagio = 'CADASTRO';
        $fac->prioridade = 'ALTA';
        $fac->origem = 'SITE';
        $fac->agencia_id = 24;
        $fac->chave_id = $this->contato->id;
        $fac->cadastro = date('Y-m-d H:i:s');
        $fac->atualizacao = date('Y-m-d H:i:s');
        $fac->nome = $this->contato->nome;
        $fac->ddd1 = $this->contato->ddd1;
        $fac->telefone1 = $this->contato->telefone1;
        $fac->email = $this->contato->email;
        $fac->res_estado = $this->contato->estado;
        $fac->res_codcidade = $this->contato->codcidade;
        $fac->res_codbairro = $this->contato->codbairro;
        $fac->saveOrFail();
    }

}
