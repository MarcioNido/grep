<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Site\Imovel;
use App\Site\Localidade;

class importaLocalidade extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'guru:importaLocalidade';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Importa localidades da tabela de imoveis';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        \Illuminate\Support\Facades\DB::table('localidades')->truncate();
        
        // importa cidades 
        $cidades = Imovel::select('estado', 'cidade')->distinct()->get();
        foreach($cidades as $cidade) {
            
            echo "Cidade: ".$cidade->cidade." - ".$cidade->estado."\n";
            
            try {
                Localidade::create(
                        [
                            'nome' => mb_convert_case(trim($cidade->cidade), MB_CASE_TITLE),
                            'descricao' => mb_convert_case(trim($cidade->cidade), MB_CASE_TITLE)." - ".$cidade['estado'],
                            'url'=> $this->toUrl(trim($cidade->estado)).'/'.$this->toUrl(trim($cidade->cidade)).'/todas-as-regioes',
                        ]);
            } catch (Illuminate\Database\QueryException $ex) {

                echo "Erro ao inserir ... \n";
                    
            } catch (\PDOException $e) {
                dd($e->getMessage());
                echo "Erro PDO ... \n";
            }
        }
        

        // importa regioes 
        $regioes = Imovel::whereIn('cidade', ['Sao Paulo', 'Brasilia', 'Aruja'])->select('estado', 'cidade', 'regiao_mercadologica')->distinct()->get();
        foreach($regioes as $regiao) {
            
            if (trim($regiao->regiao_mercadologica) == '') continue;
            
            echo "Regiao: ".$regiao->regiao_mercadologica." - ".$regiao->cidade." - ".$regiao->estado."\n";
            
            try {
                Localidade::create(
                        [
                            'nome' => mb_convert_case(trim($regiao->regiao_mercadologica), MB_CASE_TITLE),
                            'descricao' => mb_convert_case(trim($regiao->regiao_mercadologica), MB_CASE_TITLE)." - ".mb_convert_case(trim($regiao->cidade), MB_CASE_TITLE)." - ".$regiao['estado'],
                            'url'=> $this->toUrl($regiao->estado).'/'.$this->toUrl(trim($regiao->cidade)).'/'. $this->toUrl(trim($regiao->regiao_mercadologica)),
                        ]);
                
            } catch (Illuminate\Database\QueryException $ex) {

                echo "Erro ao inserir ... \n";
                    
            } catch (\PDOException $e) {
                dd($e->getMessage());
                echo "Erro PDO ... \n";
            }
        }
        
        
        
    }
    
    public function toUrl($termo) {
        
          echo "before:".$termo."\n";
          //$termo = mb_convert_encoding($termo, 'UTF-8');
          
          // the ugly way !!! is the best ... iconv didn´t work at all !!! 
          $termo = preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/","/(ç)/","/(Ç)/"),explode(" ","a A e E i I o O u U n N c C"),$termo);          
          //$termo = strtr($termo,'àáâãäçèéêëìíîïñòóôõöùúûüýÿÀÁÂÃÄÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜÝ','aaaaaceeeeiiiinooooouuuuyyAAAAACEEEEIIIINOOOOOUUUUY');
          $termo = str_replace(" ", "-", $termo);
          $termo = str_replace("'", "", $termo);
          $termo = strtolower($termo);
          echo "after:".$termo."\n";
          return $termo;
    }     
    
}
