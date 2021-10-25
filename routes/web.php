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
Route::post('/reservation', 'ReservationController@index');

/*
 * Routes pour paiement
 * Etre connecté pour pouvoir y accéder
 */
Route::group(['middleware' => ['auth']], function(){
    Route::get('/paiement', 'PaiementController@index')->name('paiement.index');
    Route::get('/paiementstore', 'PaiementController@store')->name('paiement.store');
    Route::get('/paiementreussi', 'PaiementController@paiementreussi')->name('paiement.reussi');
    Route::get('/representations/{id}', 'RepresentationController@index')->name('representations.index');
    Route::get('/cart', 'CartController@index')->name('cart');
    Route::post('/add-to-cart', 'CartController@addToCart')->name('add.to.cart');
    Route::delete('/remove-from-cart', 'CartController@remove')->name('remove.from.cart');
    Route::get('/cart/historique', 'CartController@historique')->name('cart.historique');
});

/*
 * Default routes
 */
Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
