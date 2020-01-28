<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/v1/clients', function(Request $request) {
  return 'S T U D E N T S';
});

Route::post('/v1/register', 'Api\AuthController@register');
Route::post('/login', 'Api\AuthController@login');

Route::get('/v1/domains', 'Api\DomainsController@index', function() {
})->middleware('auth:api');

Route::get('/v1/whois', 'Api\WhoisController@getData', function() {});
