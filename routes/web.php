<?php

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
Route::get('{agencia_sigla}/imoveis', function($agencia_sigla) {
    $agencia = \App\Site\Agencia::where('agencia_sigla', $agencia_sigla)->first();
    return redirect('http://'.$agencia->subdomain.'.leardi.com.br');
});

// Site Routes
Route::group(['namespace' => 'Site', 'domain' => '{unidade}.leardi.com.br'], function() {
    Route::get('/', 'HomeController@index');
    Route::get('/home', 'HomeController@index');

    // lista de imoveis
    Route::any('/venda/{estado}/{cidade}/{regiao}/{tipo_imovel}', 'PesquisaController@venda');
    Route::any('/locacao/{estado}/{cidade}/{regiao}/{tipo_imovel}', 'PesquisaController@locacao');
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

    Route::get('/pesquisa/{expression1?}/{expression2?}/{expression3?}/{expression4?}/{expression5?}/{expression6?}/{expression7?}/{expression8?}/{expression9?}/{expression10?}', 'InteracaoController@index');
//'<agencia_sigla:([0-9]+)>/imoveis'=>'unidade/imoveis',

});

// area restrita
Route::group(['namespace' => 'Site', 'middleware' => 'auth', 'domain' => '{unidade}.leardi.com.br'], function() {
    Route::get('/area-restrita/index', 'AreaRestritaController@index');
    Route::get('/area-restrita/edita-alerta/{id}', 'AreaRestritaController@editaAlerta');
    Route::post('/area-restrita/edita-alerta/{id}', 'AreaRestritaController@storeAlerta');
    Route::get('/area-restrita/cancela-alerta/{id}', 'AreaRestritaController@cancelaAlerta');
    Route::post('/area-restrita/cancela-alerta/{id}', 'AreaRestritaController@cancelaAlerta');
    Route::any('/area-restrita/cadastro-imovel/{id?}', 'CadastroImovelController@edita');
    Route::any('/area-restrita/cancela-imovel/{id}', 'CadastroImovelController@cancelaImovel');
    Route::get('/area-restrita/drop-down/tipo-imovel/{codtiposimplificado?}', 'CadastroImovelController@tipoimovel');
    Route::get('/area-restrita/drop-down/cidade/{estado?}', 'CadastroImovelController@cidade');
    Route::get('/area-restrita/drop-down/bairro/{codcidade?}', 'CadastroImovelController@bairro');
    Route::get('/area-restrita/busca-cep/{cep?}', 'CadastroImovelController@cep');
    Route::any('/area-restrita/envia-fotos/{id}', 'CadastroImovelController@enviaFotos');
    Route::get('/area-restrita/fotos-enviadas', 'CadastroImovelController@fotosEnviadas');
    Route::any('/area-restrita/trabalhe-conosco/{id?}', 'TrabalheConoscoController@edita');
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
