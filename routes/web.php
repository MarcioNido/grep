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

// Site Routes
Route::group(['namespace' => 'Site'], function() {
    Route::get('/', 'HomeController@index');
    Route::get('/home', 'HomeController@index');

    // lista de imoveis
    Route::post('/venda/{estado}/{cidade}/{regiao}/{tipo_imovel}', 'PesquisaController@venda');    
    Route::post('/locacao/{estado}/{cidade}/{regiao}/{tipo_imovel}', 'PesquisaController@locacao');
    Route::get('/venda/{estado}/{cidade}/{regiao}/{tipo_imovel}', 'PesquisaController@venda');
    Route::get('/locacao/{estado}/{cidade}/{regiao}/{tipo_imovel}', 'PesquisaController@locacao');

    // detalhes do imóvel
    Route::get('/imovel/{imovel_id}', 'PesquisaController@detalhe');
    Route::get('/pesquisa/fone/{agencia_id}', 'PesquisaController@fone'); // botão VER TELEFONE
    Route::get('/pesquisa/getCoordinates/{id}', 'PesquisaController@getCoordinates'); // VER MAPA

    // lista das agencias
    Route::get('/agencias', 'AgenciaController@lista');

});

// Blog Routes
Route::group(['namespace' => 'Blog'], function() {
    Route::get('/blogleardi', 'BlogController@lista');
    Route::get('/blogleardi/{key}', 'BlogController@viewPost');
});