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

Route::post('/v1/register', 'Api\AuthController@register');
Route::post('/login', 'Api\AuthController@login');

/*
Route::get('/v1/domains', 'Api\DomainController@index', function() {
})->middleware('auth:api');
*/

Route::get('/v1/domains', 'Api\DomainController@index', function() {});
Route::get('/v1/clients', 'Api\ClientController@index', function() {});
Route::get('/v1/services', 'Api\ServiceController@index', function() {});

// WHOIS 3rd party integration
Route::get('/v1/whois', 'Api\WhoisController@getData', function() {});

