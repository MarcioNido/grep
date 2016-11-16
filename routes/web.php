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
    
    Route::post('/venda/{estado}/{cidade}/{regiao}/{tipo_imovel}', 'PesquisaController@venda');    
    Route::post('/locacao/{estado}/{cidade}/{regiao}/{tipo_imovel}', 'PesquisaController@locacao');
    
    Route::get('/venda/{estado}/{cidade}/{regiao}/{tipo_imovel}', 'PesquisaController@venda');
    Route::get('/locacao/{estado}/{cidade}/{regiao}/{tipo_imovel}', 'PesquisaController@locacao');
    
});

