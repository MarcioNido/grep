<?php

namespace App\Bdi\Observers;

use App\Bdi\Jobs\CadastroImovelFacJob;
use App\Site\CadImovel;
use App\Bdi\Jobs\CadastroImovelEmailJob;
/**
 * Class CadastroImovelObserver
 * This class will listen to new contacts from the site and trigger the BDI specific jobs
 * like send email to the agency, create the pre-atendimento fac, etc ...
 *
 * This way, we keep the BDI specific stuff apart from the grep code ...
 */
class CadastroImovelObserver
{
    /**
     * Listen to the created event of Contato Model
     * @param CadImovel $cadImovel
     */
    public function created(CadImovel $cadImovel)
    {
        $jobEmail = (new CadastroImovelEmailJob($cadImovel))->onQueue('main');
        dispatch($jobEmail);

//        $jobFac = (new CadastroImovelFacJob($cadImovel))->onQueue('main');
//        dispatch($jobFac);
    }

}