<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Site\ImovelSearch;
class ImovelSearchTest extends TestCase
{

    use DatabaseTransactions;

    /** @test */
    public function a_basic_post_search_returns_rows()
    {
        $request = \Illuminate\Http\Request::create('/venda/sp/sao-paulo/brooklin/apartamento', 'POST', ['tipo_negocio' => 'venda', 'tipo_imovel' => 'apartamento', 'localidade_url' => 'sp/sao-paulo/brooklin'], [], []);
        $request->setSession($this->app['session.store']);

        $imovelSearch = (new ImovelSearch($request));
        $imovelSearch->processSearchRequest();

        $this->assertNotEmpty($imovelSearch->imoveis);
    }

}
