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
    return view('app');
});

Route::get('/', 'DomainController@index');
Route::get('/domain/add', 'DomainController@add');
Route::get('/domain/create', 'DomainController@create');

/*
Route::get('/debug-sentry', function () {
    throw new Exception('My first Sentry error!');
});
*/

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

// Domains resources (i.e data to populate datatables)
Route::resource('domain', 'DomainController');