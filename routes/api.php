<?php

use Illuminate\Http\Request;



Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('produtos', 'ProdutoController@index');
Route::post('produtos', 'ProdutoController@store');
Route::get('produtos/edit/{id}', 'ProdutoController@edit');
Route::get('produtos/show/{id}', 'ProdutoController@show');
Route::put('produtos/update/{id}', 'ProdutoController@update');
Route::delete('produtos/delete/{id}', 'ProdutoController@destroy');
