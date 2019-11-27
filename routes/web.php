<?php

/*
Route::get('/landing', function () {
    return view('layouts.landing_checkout');
});
*/


Route::get("/privacidad", function(){
   return View::make("layouts.privacy");
})->name('privacy');

Route::get("/retracto", function(){
   return View::make("layouts.retracto");
})->name('retracto');


Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
Route::get('/verify-user/{code}', 'RegisterController@activateUser')->name('activate.user');

Route::get('payu', 'PayuController@index')->name('payu');




//$this->get('/cancelar-suscripcion/{code}', 'NewsLetterController@cancelar_suscripcion')->name('cancelar_suscripcion');

Route::post('/send_mail', 'WelcomeMainController@send_mail')->name('send_mail');

Route::get('auth/{provider}', 'Auth\SocialAuthController@redirectToProvider')->name('social.auth');
Route::get('auth/{provider}/callback', 'Auth\SocialAuthController@handleProviderCallback');


Route::get('/', 'WelcomeMainController@index')->name('welcome');
Route::get('home', 'WelcomeMainController@index')->name('home');
Route::get('/clear', 'WelcomeMainController@clear')->name('clear');


Route::get('/about_us', 'ContactController@about_us')->name('about_us');
Route::get('/faq', 'ContactController@faq')->name('faq');
Route::get('sitemap', 'ContactController@sitemap')->name('sitemap');


Route::get('search', 'StoreController@search')->name('store.search');

Route::get('/epayco', 'ePaycoController@index')->name('epayco');

Route::get('/contactanos', 'ContactController@index')->name('contact');
Route::get('/sesion/{grid}', 'NewController@sesion')->name('sesion');

Route::get('/resumen', 'ResumenController@index')->name('resumen');
Route::post('/resumen', 'ResumenController@store')->name('resumen.store');
Route::post('/select_city', 'APIController@select_city')->name('select_city');
Route::delete('/resumen/{product}', 'ResumenController@destroy')->name('resumen.destroy');
Route::patch('/resumen/{product}/', 'ResumenController@update')->name('resumen.update');

Route::get('/resumen/checkout', 'CheckoutController@index')->name('checkout')->middleware('auth');

Route::get('trm/update', 'TrmController@webservistrm')->name('trm.update');
Route::get('/notifications.mp', 'MercadoPagoController@index')->name('notifications.mp');

Route::post('/sql_session', 'APIController@sql_session')->name('sql_session');
Route::get('trm', 'TrmController@webservistrm')->name('trm');

Route::get('/trmdelete', 'TrmController@delete')->name('trm_delete');


Route::post('checkout/landing','CheckoutController@store')->name('checkout.store');
//Route::get('landing','CheckoutController@test')->name('test');

Route::get('api/dependent-dropdown','APIController@index');
Route::get('api/get-state-list','APIController@getStateList');
Route::get('api/get-state-list2','APIController@getStateList2');
Route::get('api/get-city-list','APIController@getCityList');
Route::get('api/get-city-list2','APIController@getCityList2');
Route::post('/checksession','APIController@checksession')->name('checksession');

Auth::routes();
//Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password_reset');

// Registration Routes...
Route::get('/register', 'RegisterController@index')->name('register');
Route::post('/register', 'RegisterController@register')->name('register');
Route::get('/register/empresa', 'RegisterController@register_empresa')->name('register.empresa');
Route::post('/register.empresa.store', 'RegisterController@register_empresa_store')->name('register.empresa.store');
//Route::post('/registrar', 'RegisterController@create')->name('register.create');

//$this->get('/verify-user/{code}', 'RegisterController@activateUser')->name('activate.user');


//aca cambiar por slugable
Route::get('/{slug}_', 'ProductController@show')->name('product.show');


Route::get('/store-list', 'StoreController@index2')->name('store.list');











//Route::get('/store/{url}', 'StoreController@categoria_get')->name('categoria.get');
Route::get('/store', 'StoreController@index')->name('store.index');


Route::get('novedades', 'StoreController@novedades')->name('novedades.index');
Route::get('ofertas', 'StoreController@ofertas')->name('ofertas.index');



Route::get('/{cat2}/{id}/', 'NewController@index')->name('categoria.get');

Route::get('/filtros/{id}/', 'FiltrosController@show')->name('filtros.get');



/* CATEGORIAS RUTAS*/
Route::get('categoria/{id}', 'StoreController@categorias_get')->name('categoria.look');





//filtros
Route::post('filtros.get', 'FiltrosController@show')->name('filtros.get');



Route::group(['middleware' => 'auth'], function () {

//Route::get('/test', 'TestController@index')->name('test');

Route::get('/favoritos', 'FavoritosController@index')->name('favoritos');

Route::post('favoritosf/{id}', 'FavoritosController@swichtToFavorite')->name('favoritos.swichtf');

Route::get('/favoritos/{product}/referencia/{referencia}', 'FavoritosController@store')->name('favoritos.store');
Route::post('/favoritos', 'FavoritosController@destroy')->name('favoritos.destroy');
Route::post('favoritosc/{id}', 'FavoritosController@swichtToCheckout')->name('favoritos.swicht');
//Route::post('/flete_value', 'SaferboController@flete_value')->name('flete_value');
Route::post('/flete_value', 'TransportadoresController@flete_value')->name('flete_value');
Route::post('direccion.store', 'DireccionesController@store')->name('direccion.store');
Route::post('direccion.select', 'DireccionesController@select')->name('direccion.select');

Route::get('/micuenta', 'MyAccountController@index')->name('my_account');
Route::post('password.change', 'MyAccountController@password_change')->name('password.change');

/*
Route::get("/checkout/landing/test", function(){
   return View::make("layouts.checkout_landing");
});

*/

});
