<?php

namespace App\Bdi\Observers;

use App\Bdi\Jobs\FranqueadoEmailJob;
use App\Bdi\Jobs\FranqueadoFacJob;
use App\Site\Contato;
use App\Site\ContatoFranqueado;

/**
 * Class ContatoObserver
 * This class will listen to new contacts from the site and trigger the BDI specific jobs
 * like send email to the agency, create the pre-atendimento fac, etc ...
 *
 * This way, we keep the BDI specific stuff apart from the grep code ...
 */
class FranqueadoObserver
{
    /**
     * Listen to the created event of Contato Model
     * @param ContatoFranqueado $contato
     */
    public function created(ContatoFranqueado $contato)
    {
        $jobEmail = (new FranqueadoEmailJob($contato))->onQueue('main');
        dispatch($jobEmail);

        $jobFac = (new FranqueadoFacJob($contato))->onQueue('main');
        dispatch($jobFac);
    }

}