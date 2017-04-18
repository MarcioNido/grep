<?php

namespace App\Bdi\Observers;

use App\Bdi\Jobs\FranqueadoEmailJob;
use App\Bdi\Jobs\FranqueadoFacJob;
use App\Bdi\Jobs\TrabalheConoscoEmailJob;
use App\Bdi\Jobs\TrabalheConoscoFacJob;
use App\Site\Contato;
use App\Site\ContatoFranqueado;
use App\Site\TrabalheConosco;

/**
 * Class TrabalheConoscoObserver
 * This class will listen to new contacts from the site and trigger the BDI specific jobs
 * like send email to the agency, create the pre-atendimento fac, etc ...
 *
 * This way, we keep the BDI specific stuff apart from the grep code ...
 */
class TrabalheConoscoObserver
{
    /**
     * Listen to the created event of Contato Model
     * @param TrabalheConosco $contato
     */
    public function created(TrabalheConosco $contato)
    {
        $jobEmail = (new TrabalheConoscoEmailJob($contato))->onQueue('main');
        dispatch($jobEmail);

        $jobFac = (new TrabalheConoscoFacJob($contato))->onQueue('main');
        dispatch($jobFac);
    }

}