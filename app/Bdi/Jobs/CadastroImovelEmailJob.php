<?php

namespace App\Bdi\Jobs;

use App\Mail\CadastroImovelEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Site\CadImovel;
use Illuminate\Support\Facades\Mail;

class CadastroImovelEmailJob implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    protected $cadImovel;

    /**
     * Create a new job instance.
     * @param CadImovel $cadImovel
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
        $dest = $this->cadImovel->agencia->email;
        if ($dest == null || $dest == '') {
            $dest = 'site@leardi.com.br';
        }
        Mail::to($dest)->send(new CadastroImovelEmail($this->cadImovel));
    }
}
