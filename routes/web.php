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

// Domains
Route::get('/', 'DomainController@index')->name('domain.index');
Route::get('/domain/add', 'DomainController@add');
Route::get('/domain/create', 'DomainController@create');
Route::get('/domain/{id}/edit', 'DomainController@edit');
Route::post('/domain/store', 'DomainController@store')->name('domain.store');
Route::post('/domain/update', 'DomainController@update')->name('domain.update');
Route::get('/domain/{id}/destroy', 'DomainController@destroy')->name('domain.destroy');

// This route hits an internal API gateway to the WHOIS API, which in turn returns domain related data
Route::get('domain/{url}/refresh', 'WhoisController@getData')->name('domain.refresh');

// Clients
Route::get('/clients', 'ClientController@index')->name('client.index');
Route::get('/client/add', 'ClientController@@add');
Route::get('/client/create', 'ClientController@create');
Route::get('/client/{id}/edit', 'ClientController@edit');
Route::post('/client/store', 'ClientController@store')->name('client.store');
Route::post('/client/update', 'ClientController@update')->name('client.update');
Route::get('/client/{id}/destroy', 'ClientController@destroy')->name('client.destroy');

// Services
Route::get('/services', 'ServiceController@index')->name('service.index');
Route::get('/service/add', 'ServiceController@@add');
Route::get('/service/create', 'ServiceController@create');
Route::get('/service/{id}/edit', 'ServiceController@edit');
Route::post('/service/store', 'ServiceController@store')->name('service.store');
Route::post('/service/update', 'ServiceController@update')->name('service.update');
Route::get('/service/{id}/destroy', 'ServiceController@destroy')->name('service.destroy');


///**
// * This is a sentry test route
// */
//Route::get('/debug-sentry', function () {
//    throw new Exception('My first Sentry error!');
//});

/*
Route::get('/redirect', function (\Illuminate\Http\Request $request) {
    $request->session()->put('state', $state = \Illuminate\Support\Str::random(40));

    $query = http_build_query([
        'client_id' => '3',
        'redirect_uri' => 'http://domains-manager.test/auth/callback',
        'response_type' => 'dr4tx7Rfkkx9VUlLItP9Sve4lQX0UWa8gY9m8t3F',
        'scope' => '',
        'state' => $state,
    ]);

    return redirect('http://domains-manager.test/oauth/authorize?'.$query);
});
*/

