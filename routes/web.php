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

Route::get('/', function () {
    return view('welcome');
});
// Route::get('/{node_id}/{node_data}', function($node_id,$node_data)
// {
// 	return $node_id + $node_data ;
// });

Route::post('/node/report/{node_id}', 'node_data@store');
Route::post('/node/create','node_data@create');
Route::get('node/show/{node_id}', 'node_data@show');