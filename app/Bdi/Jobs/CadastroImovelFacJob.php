<?php
namespace App\Bdi\Jobs;

use App\Bdi\FacBdi;
use App\Bdi\FacBdiPreCadastro;
use App\Bdi\ImovelProfissional;
use App\Bdi\ImovelProvisorio;
use App\Bdi\Pfj;
use App\Bdi\Profissional;
use App\Crypto;
use App\Site\CadImovel;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\DB;

/**
 * Class CadastroImovelFacJob
 * Will create the fac record in bdi application
 * Triggered by the App\Bdi\Observers\CadastroImovelObserver class
 *
 * @package App\Bdi\Jobs
 */
class CadastroImovelFacJob implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    protected $cadImovel;

    public $crypto;

    /**
     * Create a new job instance.
     */
    public function __construct(CadImovel $cadImovel)
    {
        $this->cadImovel = $cadImovel;

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        DB::transaction(function() {
            $facbdi_id = $this->createFacBDI();
            $this->createFacBdiPreCadastro($facbdi_id);
            $this->createImovelProvisorio($facbdi_id);
        });
    }

    private function createFacBDI()
    {
        $fac = new FacBdi();
        $fac->agencia_id = $this->cadImovel->agencia_id;
        $fac->dh_criacao = date('Y-m-d H:i:s');
        $fac->dh_pre_cadastro = date('Y-m-d H:i:s');
        $fac->profissional_pre_cadastro_id = 2654; // PRODUCAO
        $fac->cli_nome = $this->cadImovel->nome;
        $fac->cli_ddd1 = $this->cadImovel->ddd1;
        $fac->cli_telefone1 = $this->cadImovel->telefone1;
        $fac->cli_ddd2 = $this->cadImovel->ddd2;
        $fac->cli_telefone2 = $this->cadImovel->telefone2;
        $fac->cli_email = $this->cadImovel->email;
        $fac->imovel_id = $this->cadImovel->imovel_id;
        $fac->referencias = $this->cadImovel->imovel_id;
        $fac->codtipofac = 10;
        $fac->origem_avaliacao = 'SITE LEARDI';
        $fac->obs = $this->cadImovel->mensagem;
        $fac->saveOrFail();
        return $fac->facbdi_id;
    }

    private function createFacBdiPreCadastro($facbdi_id)
    {
        $pre = new FacBdiPreCadastro();
        $pre->facbdi_id         = $facbdi_id;
        $pre->tipo_imovel       = $this->cadImovel->codtiposimplificado;
        $pre->sub_tipo_imovel   = $this->cadImovel->codtipoimovel;
        $pre->endereco          = $this->cadImovel->tipo_logradouro." ".$this->cadImovel->endereco;
        $pre->numero            = $this->cadImovel->numero;
        $pre->unidade           = $this->cadImovel->unidade;
        $pre->bloco             = $this->cadImovel->bloco;
        $pre->complemento       = $this->cadImovel->complemento;
        $pre->bairro            = $this->cadImovel->bairro->descricao;
        $pre->cep               = $this->cadImovel->cep;
        $pre->cidade            = $this->cadImovel->cidade->descricao;
        $pre->estado            = $this->cadImovel->estado;
        $pre->valor_venda       = $this->cadImovel->valor_venda;
        $pre->valor_locacao     = $this->cadImovel->valor_locacao;
        $pre->obs_imovel        = $this->cadImovel->obs_imovel;
        $pre->saveOrFail();
    }

    protected function createImovelProvisorio($facbdi_id) {

        $this->crypto = new Crypto();

        // INCLUI O PROPRIETARIO
        $codagencia = $this->cadImovel->agencia()->codagencia;
        $codpfj = Pfj::where('codagencia', $codagencia)->max('codpfj');

        if ($codpfj == null) $codpfj = 0;
        $codpfj = $codpfj + 1;

        $pfj = new Pfj();
        $pfj->codagencia = $codagencia;
        $pfj->codpfj = $codpfj;

        $pfj->tratamento = "";
        $pfj->nome = $this->cadImovel->nome;
        $pfj->fj = 'F';
        $pfj->proprietario = 1;
        $pfj->cliente = 0;
        $pfj->crypt_cpfcnpj = $this->crypto->encrypt($this->cadImovel->cpf);
        $pfj->crypt_rgie = $this->crypto->encrypt("");
        $pfj->ddi1 = "";
        $pfj->ddd1 = $this->cadImovel->ddd1;

        $pfj->crypt_telefone1 = $this->crypto->encrypt($this->cadImovel->telefone1);
        $pfj->ramal1 = "";
        $pfj->descricao1 = "";
        $pfj->ddi2 = "";
        $pfj->ddd2 = $this->cadImovel->ddd2;
        $pfj->crypt_telefone2 = $this->crypto->encrypt($this->cadImovel->telefone2);
        $pfj->ramal2 = "";
        $pfj->descricao2 = "";
        $pfj->ddi3 = "";
        $pfj->ddd3 = "";
        $pfj->crypt_telefone3 = $this->crypto->encrypt("");
        $pfj->ramal3 = "";
        $pfj->descricao3 = "";
        $pfj->crypt_email1 = $this->crypto->encrypt($this->cadImovel->email);
        $pfj->crypt_email2 = $this->crypto->encrypt("");
        $pfj->situacao = 'Ativo';
        $pfj->lps_codigoant = "SITEBDI".str_pad($this->cadImovel->id, 10, '0', STR_PAD_LEFT);
        $pfj->cep = "";
        $pfj->endereco = "";
        $pfj->numero = 0;
        $pfj->complemento = "";
        $pfj->bairro = "";
        $pfj->cidade = "";
        $pfj->estado = "";
        $pfj->sexo = "";
        $pfj->nascimento = "1901-01-01";
        $pfj->codestadocivil = 0;
        $pfj->dependentes = 0;
        $pfj->codprofissao = 0;
        $pfj->codramoatividade = 0;
        $pfj->contato1 = "";
        $pfj->cargo1 = "";
        $pfj->contato2 = "";
        $pfj->cargo2 = "";
        $pfj->contato3 = "";
        $pfj->cargo3 = "";
        $pfj->saveOrFail();

        $pp = array(
            'pfj_id'=>$pfj->pfj_id,
            'codagencia'=>$pfj->codagencia,
            'codpfj'=>$pfj->codpfj
        );

        $agencia_id = $this->cadImovel->agencia_id;
        $codimovel = ImovelProvisorio::where('codagencia', $codagencia)->max('codimovel');
        if ($codimovel == null) $codimovel = 0;
        $codimovel = $codimovel + 1;

        $imovel = new ImovelProvisorio();
        $imovel->codagencia = $codagencia;
        $imovel->codimovel = $codimovel;
        $imovel->lps_codimovelant = "SITEBDI".str_pad($this->cadImovel->id, 10, '0', STR_PAD_LEFT);

        $imovel->agencia_captadora_id = $agencia_id;
        $imovel->agencia_gestora_id = $agencia_id;
        $imovel->agencia_publicidade_id = $agencia_id;
        $imovel->listado = 2;
        $imovel->base_id = 0;
        $imovel->empreendimento_id = 0;
        $imovel->codagenciagestora = $codagencia;
        $imovel->pfj_id = $pp['pfj_id'];
        $imovel->codpfjagencia = $pp['codagencia'];
        $imovel->codpfj = $pp['codpfj'];

        $imovel->codtiposimplificado = $this->cadImovel->codtiposimplificado;
        $imovel->codtipoimovel = $this->cadImovel->codtipoimovel;
        $imovel->codtipoorigem = 4; // site
        $imovel->codclassificacao = 1;
        $imovel->utilizares = 1;
        $imovel->situacao = 4; // provisorio
        $imovel->situacaodetalhe = 7; // provisorio
        $imovel->datacadastro = date('Y-m-d H:i:s');
        $imovel->dataatualizacao = date('Y-m-d H:i:s');
        $imovel->dataalteracao = date('Y-m-d H:i:s');
        $imovel->dataatualizapro = date('Y-m-d H:i:s');
        $imovel->cep = $this->cadImovel->cep;
        $imovel->siglaestado = $this->cadImovel->estado;
        $imovel->codcidade = $this->cadImovel->codcidade;
        $imovel->codbairro = $this->cadImovel->codbairro;
        $imovel->codbairrorm = $this->cadImovel->codbairro;
        $imovel->logradouro = $this->cadImovel->tipo_logradouro;
        $imovel->endereco = mb_convert_case($this->cadImovel->endereco, MB_CASE_UPPER);
        $imovel->numero = $this->cadImovel->numero;
        $imovel->unidade = $this->cadImovel->unidade;
        $imovel->bloco = $this->cadImovel->bloco;
        $imovel->complemento = $this->cadImovel->complemento;

        $imovel->areatotalterreno = $this->cadImovel->areatotalterreno;
        $imovel->areautilconstruida = $this->cadImovel->areautilconstruida;

        $imovel->dormitorio = $this->cadImovel->dormitorio;
        $imovel->suite = $this->cadImovel->suite;
        $imovel->vaga = $this->cadImovel->vaga;

        $imovel->disponivelvenda = (float) $this->cadImovel->valor_venda != 0 ? 1 : 0;
        $imovel->valorvenda = $this->cadImovel->valor_venda;
        $imovel->disponivellocacao = (float) $this->cadImovel->valor_locacao != 0 ? 1 : 0;
        $imovel->valorlocacao = $this->cadImovel->valor_locacao;

        $imovel->valorcondominio = $this->cadImovel->valor_condominio;
        $imovel->valoriptu = $this->cadImovel->valor_iptu;

        $imovel->textointerno = $this->cadImovel->obs_imovel;

        $imovel->codempreendimentoagencia = "";
        $imovel->codempreendimento = 0;
        $imovel->remanescente = 0;
        $imovel->contribuinte = "";
        $imovel->registro = "";
        $imovel->transcricao = "";
        $imovel->matricula = "";
        $imovel->situacaomsg = "";
        $imovel->alertafollowup = 0;
        $imovel->nomebairro = "";
        $imovel->nomelocalidade = "";
        $imovel->quadralote = "";
        $imovel->lote = "";
        $imovel->df_quadra = "";
        $imovel->df_lote = "";
        $imovel->df_conjunto = "";
        $imovel->imediacoes = "";
        $imovel->esquina = 0;
        $imovel->zoneamento = "";
        $imovel->face = "";
        $imovel->topografia = "";
        $imovel->latitude = "";
        $imovel->longitude = "";
        $imovel->chaves = "";
        $imovel->edificio = "";
        $imovel->condominio = "";
        $imovel->construtora = "";
        $imovel->anoconstrucao = 0;
        $imovel->zelador = "";
        $imovel->foneportaria = "";
        $imovel->nopool = 0;
        $imovel->administradora = "";
        $imovel->foneadministradora = "";
        $imovel->protegido = 0;
        $imovel->metragemfrente = 0;
        $imovel->metragemfundo = 0;
        $imovel->metragemdireita = 0;
        $imovel->metragemesquerda = 0;
        $imovel->pedireito = 0;
        $imovel->areacarpete = 0;
        $imovel->areaescritorio = 0;
        $imovel->areaapoio = 0;
        $imovel->areafabril = 0;
        $imovel->areapatio = 0;
        $imovel->qtdeblocos = 0;
        $imovel->qtdeandares = 0;
        $imovel->qtdeporandar = 0;
        $imovel->banheiro = 0;
        $imovel->sala = 0;
        $imovel->valorvendam2 = 0;
        $imovel->valorlocacaom2 = 0;
        $imovel->disponiveltemporada = 0;
        $imovel->valortemporada = 0;
        $imovel->qtdepessoas = 0;
        $imovel->permutadetalhe = "";
        $imovel->aceitafinanciamento = 0;
        $imovel->finandetalhe = "";
        $imovel->finanentrada = 0;
        $imovel->finanparcela = 0;
        $imovel->finannumparc = 0;
        $imovel->custoefetivototal = 0;
        $imovel->possuirenda = 0;

        // pega o profissional
        $profissional = Profissional::where('situacao', 'Ativo')
            ->where('agencia_id', $this->cadImovel->agencia_id)
            ->where('codnivel', 34)->first();

        if (! $profissional) {
            $profissional =Profissional::where('situacao', 'Ativo')
                ->where('agencia_id', $this->cadImovel->agencia_id)
                ->where('codnivel', 42)->first();
        }

        if (! $profissional) {
            $profissional = Profissional::where('codprofissional', 'CP0002')->first();
        }

        $imovel->indicador1 = $profissional->codprofissional;
        $imovel->promotor1 = $profissional->codprofissional;

        $imovel->saveOrFail();

        // imovelprofissional

        ImovelProfissional::where(['codagencia'=>$codagencia, 'codimovel' => $codimovel])->delete();
        ImovelProfissional::insert([
            'codagencia'=>$codagencia,
            'codimovel'=>$codimovel,
            'ordem'=>1,
            'codrelacao'=>1,
            'codprofissional'=>$profissional->codprofissional,
        ]);
        ImovelProfissional::insert([
            'codagencia'=>$codagencia,
            'codimovel'=>$codimovel,
            'ordem'=>2,
            'codrelacao'=>2,
            'codprofissional'=>$profissional->codprofissional,
        ]);

        // inclui imovel na lista de imoveis selecionados da FAC de avaliacao
        FacBdi::where('facbdi_id', $facbdi_id)->update(['referencias' => $imovel->imovel_id, 'imovel_id' => $imovel->imovel_id]);

    }

}