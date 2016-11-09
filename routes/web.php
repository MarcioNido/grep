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

Route::group(['namespace' => 'Site'], function() {
    Route::get('/', 'HomeController@index');
    Route::get('/home', 'HomeController@index');
    Route::get('/venda/{estado}/{cidade}/{regiao}/{tipo_imovel}', 'PesquisaController@generate');
    Route::post('/venda/{estado}/{cidade}/{regiao}/{tipo_imovel}', 'PesquisaController@generate');    
    Route::get('/locacao/{estado}/{cidade}/{regiao}/{tipo_imovel}', 'PesquisaController@generate');
    Route::post('/pesquisa/generate', 'PesquisaController@generate');
    Route::get('/pesquisa/aclocalidade', 'PesquisaController@aclocalidade');
});

