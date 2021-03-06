<?php

use \App\Http\Middleware\IsBlogAdmin;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});

Auth::routes();

// redirect rules
Route::get('{agencia_sigla}', function($agencia_sigla) {
    return redirect('http://'.$agencia_sigla.'.leardi.com.br');
})->where('agencia_sigla', '[0-9]+');

// Site Routes
Route::group(['namespace' => 'Site', 'domain' => '{unidade}.leardi.com.br'], function() {
    Route::get('/', 'HomeController@index');
    Route::get('/home', 'HomeController@index');

    Route::get('/geturl/{tipo_negocio}/{tipo_imovel}/{estado}/{codcidade}/{codbairro?}', 'PesquisaController@getUrl');

    // lista de imoveis
    Route::post('/pesquisa/digest', 'PesquisaController@digest');
    Route::any('/{tipo_negocio}/{estado}/{cidade}/{regiao}/{tipo_imovel}', 'PesquisaController@digest');
    Route::any('/pesquisa/referencia', 'PesquisaController@referencia');

    // detalhes do imóvel
    Route::get('/imovel/{imovel_id}', 'PesquisaController@detalhe');
    Route::get('/pesquisa/fone/{agencia_id}', 'PesquisaController@fone'); // botão VER TELEFONE
    Route::get('/pesquisa/getCoordinates/{id}', 'PesquisaController@getCoordinates'); // VER MAPA

    // lista das agencias
    Route::get('/agencias', 'AgenciaController@lista');
    Route::post('/agencias/search', 'AgenciaController@search');

    // mais informacoes
    Route::post('/pesquisa/contato', 'PesquisaController@storeContato');

    // quero receber novidades
    Route::get('/pesquisa/notificacao-imovel', 'PesquisaController@notificacaoImovel')->middleware('auth');

    // seja um franqueado
    Route::get('/seja-um-franqueado', 'FranqueadoController@index');
    Route::post('/seja-um-franqueado/contato', 'FranqueadoController@storeContato');

    Route::any('/pesquisa/atendimento3dias/evt_id/{evt_id}/evt_code/{evt_code}/resposta/{resposta}', 'InteracaoController@atendimento3Dias');
    Route::any('/pesquisa/atendimento10dias/evt_id/{evt_id}/evt_code/{evt_code}/resposta/{resposta}', 'InteracaoController@atendimento10Dias');
    Route::any('/pesquisa/atendimento30dias/evt_id/{evt_id}/evt_code/{evt_code}/resposta/{resposta}', 'InteracaoController@atendimento30Dias');
    Route::any('/pesquisa/atendimentoEncerrado/evt_id/{evt_id}/evt_code/{evt_code}/resposta/{resposta}', 'InteracaoController@atendimentoEncerrado');
    // http://www.leardi.com.br/emktLink/redirect1/evt_id/2452139/evt_code/S1lyM0E1eVI3TFZlYmpaYlBBeFd1UT09/imovel_id/494378-20
    Route::get('/emktLink/redirect1/evt_id/{evt_id}/evt_code/{evt_code}/imovel_id/{imovel_id}', 'InteracaoController@redirect1');
    Route::any('/mkt/replypp/evt_id/{evt_id}/evt_code/{evt_code}/resposta/{resposta}', 'InteracaoController@relAtividades');
    Route::any('/mkt/reply/id/{id}/base_id/{base_id}/opt_id/{opt_id}/code/{code}', 'InteracaoController@redirect2');
    Route::any('/mkt/reply/id/{id}/base_id/{base_id}/opt_id/{opt_id}/code/{code}/trilha/{trilha}', 'InteracaoController@redirect2');
    // http://www.leardi.com.br/mkt/replypp/evt_id/2489829/evt_code/aUZRQ05Od0FtUFdvd25MSFJ5RzNIdz09/resposta/Atualizar%20Meu%20Imóvel
    Route::get('/pesquisa/concluido', 'InteracaoController@obrigado');
    Route::get('/image/logo/evt_id/{evt_id}/evt_code/{evt_code}', 'InteracaoController@logo');
    Route::get('/image/mktLogo/id/{id}/code/{code}/trilha/{trilha?}', 'InteracaoController@mktLogo');
    Route::get('/pesquisa/{expression1?}/{expression2?}/{expression3?}/{expression4?}/{expression5?}/{expression6?}/{expression7?}/{expression8?}/{expression9?}/{expression10?}', 'InteracaoController@index');

    // dropdowns
    Route::get('/dropdown/cidade/{estado}', 'DropDownController@cidade');
    Route::get('/dropdown/bairro/{codcidade}', 'DropDownController@bairro');

    Route::get('/admin/{action}', 'HomeController@admin');
    Route::any('/area-restrita/trabalhe-conosco/{id?}/{origem?}', 'TrabalheConoscoController@edita');
    Route::get('/area-restrita/drop-down/tipo-imovel/{codtiposimplificado?}', 'CadastroImovelController@tipoimovel');
    Route::get('/area-restrita/drop-down/cidade/{estado?}', 'CadastroImovelController@cidade');
    Route::get('/area-restrita/drop-down/bairro/{codcidade?}', 'CadastroImovelController@bairro');
    Route::get('/area-restrita/busca-cep/{cep?}', 'CadastroImovelController@cep');

    Route::get('/linkedin', function() {
        return redirect('/area-restrita/trabalhe-conosco/0/linkedin');
    });
    Route::get('/Linkedin', function() {
        return redirect('/area-restrita/trabalhe-conosco/0/linkedin');
    });
    Route::get('/LinkedIn', function() {
        return redirect('/area-restrita/trabalhe-conosco/0/linkedin');
    });
    Route::get('/oportunidade', function() {
        return redirect('/area-restrita/trabalhe-conosco/0/folhapg');
    });
    Route::get('/corretor', function() {
        return redirect('/area-restrita/trabalhe-conosco/0/folhasoltos');
    });
    Route::get('/corretores', function() {
        return redirect('/area-restrita/trabalhe-conosco/0/oespsoltos');
    });
    Route::get('/catho', function() {
        return redirect('/area-restrita/trabalhe-conosco/0/catho');
    });
    Route::get('/vagas', function() {
        return redirect('/area-restrita/trabalhe-conosco/0/vagas');
    });
    Route::get('/infojobs', function() {
        return redirect('/area-restrita/trabalhe-conosco/0/infojobs');
    });
    Route::get('/curriculum', function() {
        return redirect('/area-restrita/trabalhe-conosco/0/curriculum');
    });
    Route::get('/olx', function() {
        return redirect('/area-restrita/trabalhe-conosco/0/olx');
    });
    Route::get('/ml', function() {
        return redirect('/area-restrita/trabalhe-conosco/0/mercadolivre');
    });
    Route::get('/trabalheconosco', function() {
        return redirect('/area-restrita/trabalhe-conosco/0/site');
    });
    Route::get('/trabalheConosco', function() {
        return redirect('/area-restrita/trabalhe-conosco/0/site');
    });

    Route::any('/area-restrita/cadastro-imovel/{id?}', 'CadastroImovelController@edita');
    Route::any('/area-restrita/cancela-imovel/{id}', 'CadastroImovelController@cancelaImovel');
    Route::any('/area-restrita/envia-fotos/{id}', 'CadastroImovelController@enviaFotos');
    Route::get('/area-restrita/fotos-enviadas', 'CadastroImovelController@fotosEnviadas');


//'<agencia_sigla:([0-9]+)>/imoveis'=>'unidade/imoveis',

});

// area restrita
Route::group(['namespace' => 'Site', 'middleware' => 'auth', 'domain' => '{unidade}.leardi.com.br'], function() {
    Route::get('/area-restrita/index', 'AreaRestritaController@index');
    Route::get('/area-restrita/edita-alerta/{id}', 'AreaRestritaController@editaAlerta');
    Route::post('/area-restrita/edita-alerta/{id}', 'AreaRestritaController@storeAlerta');
    Route::get('/area-restrita/cancela-alerta/{id}', 'AreaRestritaController@cancelaAlerta');
    Route::post('/area-restrita/cancela-alerta/{id}', 'AreaRestritaController@cancelaAlerta');
    Route::any('/area-restrita/dados-pessoais', 'UserController@edita');
    Route::get('/area-restrita/ebook', 'AreaRestritaController@ebook');
    Route::get('/area-restrita/ebook-download', 'AreaRestritaController@ebookDownload');
    Route::get('/area-restrita/ebook-corretor', 'AreaRestritaController@ebookCorretor');
    Route::get('/area-restrita/ebook-corretor-download', 'AreaRestritaController@ebookCorretorDownload');

});

// Blog Routes
Route::group(['namespace' => 'Blog'], function() {
    Route::get('/blogleardi', 'BlogController@lista');
    Route::get('/blogleardi/index.php/{key}', 'BlogController@viewPost');
    Route::get('/blogleardi/{key}', 'BlogController@viewPost');
});

Route::group(['namespace' => 'Blog', 'middleware' => ['auth', IsBlogAdmin::class]], function() {
    Route::get('/blogadmin', 'BlogAdminController@index');
    Route::any('/blogadmin/inclui', 'BlogAdminController@inclui');
    Route::any('/blogadmin/edita/{id}', 'BlogAdminController@edita');
});

