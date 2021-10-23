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

// Route::get('/', function () {
//     return view('welcome');
// });

/*
    @name : nécessaire pour passer la route en paramètres (form)
*/
/*Routes pour les concerts*/
Route::get('/', 'ConcertController@index')->name('concerts.index');
Route::get('/concerts', 'ConcertController@index')->name('concerts.index');
Route::get('/concerts/{slug}', 'ConcertController@show')->name('concerts.show');
Route::get('/search', 'ConcertController@search')->name('concerts.search');
Route::get('/representations/{id}', 'RepresentationController@index')->name('representations.index');
Route::post('/reservation', 'ReservationController@index');

/*  
 * Routes pour le panier
 * rowId est l'id dans le panier propre à la librairie LaravelShoppingCart, pas l'ID de la DB
 */
Route::get('/panier', 'CartController@index')->name('cart.index');
Route::post('/panier/ajouter', 'CartController@store')->name('cart.store');
Route::patch('/panier/{rowId}', 'CartController@update')->name('cart.update');
Route::delete('/panier/{rowId}', 'CartController@destroy')->name('cart.destroy');

/*
 * Routes pour paiement
 * Etre connecté pour pouvoir y accéder
 */
Route::group(['middleware' => ['auth']], function(){
    Route::get('/paiement', 'PaiementController@index')->name('paiement.index');
    Route::get('/paiementreussi', 'PaiementController@paiementreussi')->name('paiement.paiementreussi');
    Route::post('/paiement', 'PaiementController@store')->name('paiement.store');
});

/*
 * Default routes
 */
Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
