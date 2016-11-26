<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Site\Imovel;
use App\Site\ImovelCaracteristica;

class importaCaracteristica extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'guru:importaCaracteristica';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Importa caracteristicas da tabela de imoveis para a pivot table';

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

        \Illuminate\Support\Facades\DB::table('web_imovel_caracteristica')->truncate();


        $imoveis = Imovel::all();
        foreach ($imoveis as $imovel) {

            echo "Lendo imóvel {$imovel->id} ... \n";

            if ($imovel->car_unidade != '') {
                $car_unid = explode('/', $imovel->car_unidade);
                if ($car_unid) {
                    foreach ($car_unid as $car) {

                        if ( (int) $car != 0) {
                            ImovelCaracteristica::create([
                                        'imovel_id' => $imovel->id,
                                        'caracteristica_id' => (int) $car,
                                        'tipo' => 'UNIDADE',
                                    ]);
                        }

                    }
                }
            }

            if ($imovel->car_condominio != '') {
                $car_cond = explode('/', $imovel->car_condominio);
                if ($car_cond) {
                    foreach ($car_cond as $car) {

                        if ( (int) $car != 0) {
                            ImovelCaracteristica::create([
                                'imovel_id' => $imovel->id,
                                'caracteristica_id' => (int) $car,
                                'tipo' => 'CONDOMÍNIO',
                            ]);
                        }

                    }
                }
            }

        }

    }


}
