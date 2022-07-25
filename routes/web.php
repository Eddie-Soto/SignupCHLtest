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
//Route::view('mantenimiento', 'mantenimiento');

/*Rutas kit 5002*/

Route::get('/migratess', 'incorporacionController@Conexion');

Route::get('profile/{country}/{language}/kitoneusd/{sponsorid}/{kit}/{boleto}/municipality','incorporacionController@municipality');
Route::get('profile/{country}/{language}/kitoneusd/{sponsorid}/{kit}/{boleto}/ciudad','incorporacionController@ciudad');

Route::get('profile/{country}/{language}/kitoneusd/{sponsorid}/{kit}/{boleto}', 'incorporacionController@KitUSD');

Route::get('profile/{country}/{language}/kitoneusd/{sponsorid}/{kit}/{boleto}/banks','incorporacionController@getbanks');
Route::get('profile/{country}/{language}/kitoneusd/{sponsorid}/{kit}/{boleto}/gettypebankeacount','incorporacionController@gettypebankeacount');
Route::get('profile/{country}/{language}/kitoneusd/{sponsorid}/{kit}/{boleto}/states','incorporacionController@states');

Route::get('profile/{country}/{language}/kitoneusd', 'incorporacionController@KitUSD');
Route::get('/savekit', 'incorporacionController@store');

Route::get('profile/{country}/{language}/kitoneusd/{sponsorid}/{kit}/{boleto}/searchsponsor','incorporacionController@searchsponsor');
Route::get('profile/{country}/{language}/kitoneusd/{sponsorid}/{kit}/{boleto}/codegood', 'incorporacionController@Codegood');
Route::get('profile/{country}/{language}/kitoneusd/{sponsorid}/{kit}/{boleto}/searchsponsorValid','incorporacionController@searchsponsorValid');

/*Rutas kit 5002*/


/*Rutas para retomar*/
Route::get('/update', 'incorporacionController@update');
Route::get('profile/{country}/{language}/retomar', 'incorporacionController@retomar');
Route::get('/sendemail', 'incorporacionController@sendEmail');
Route::post('retomar', 'incorporacionController@retomar');
/**///Route::get('index', 'incorporacionController@profile');

Route::get('index', 'incorporacionController@mantenimiento');

Route::get('profile/{country}/{language}/sendemail', 'incorporacionController@sendEmail');

Route::get('retomar/states','incorporacionController@states');
Route::get('retomar/municipality','incorporacionController@municipality');
Route::get('retomar/ciudad','incorporacionController@ciudad');
Route::get('retomar/banks','incorporacionController@getbanks');
Route::get('retomar/gettypebankeacount','incorporacionController@gettypebankeacount');
Route::get('retomar/playeras', 'incorporacionController@playeras');

Route::get('profile/{country}/{language}/retomar/states','incorporacionController@states');
Route::get('profile/{country}/{language}/retomar/municipality','incorporacionController@municipality');
Route::get('profile/{country}/{language}/retomar/ciudad','incorporacionController@ciudad');
Route::get('profile/{country}/{language}/retomar/banks','incorporacionController@getbanks');
Route::get('profile/{country}/{language}/retomar/gettypebankeacount','incorporacionController@gettypebankeacount');
Route::get('profile/{country}/{language}/retomar/playeras', 'incorporacionController@playeras');

Route::get('profile/{country}/{language}/playeras', 'incorporacionController@playeras');
/*Rutas para retomar*/



Route::post('/save', 'incorporacionController@store');
Route::get('/', 'incorporacionController@index');
//Route::get('/', 'incorporacionController@mantenimiento');
Route::get('profile/{country}/{language}/', 'incorporacionController@profile');
//Route::get('profile/{country}/{language}/', 'incorporacionController@mantenimiento');
Route::get('profile/{country}/{language}/municipality','incorporacionController@municipality');
Route::get('profile/{country}/{language}/ciudad','incorporacionController@ciudad');
Route::get('profile/{country}/{language}/searchsponsor','incorporacionController@searchsponsor');
Route::get('profile/{country}/{language}/banks','incorporacionController@getbanks');
Route::get('profile/{country}/{language}/gettypebankeacount','incorporacionController@gettypebankeacount');
Route::get('profile/{country}/{language}/states','incorporacionController@states');
Route::get('profile/{country}/{language}/codegood', 'incorporacionController@Codegood');
Route::get('profile/{country}/{language}/searchsponsorValid','incorporacionController@searchsponsorValid');
Route::get('profile/{country}/{language}/playeras', 'incorporacionController@playeras');

Route::get('/validateRut', 'incorporacionController@valida_rut');


/* agergan datos para validación del email*/

Route::get('profile/{country}/{language}/email', 'incorporacionController@validateEmail');
Route::view('profile/{country}/{language}/Asesorespre', 'Asesorespre');

/*Routs Checkout independiente */
Route::get('incorporation/checkout','incorporacionController@checkOut');
Route::get('incorporation/checkouttv','incorporacionController@checkOutw');
Route::get('incorporation/checkoutre','incorporacionController@checkOutRe');
Route::get('incorporation/checkoutcb','incorporacionController@checkOutClub');


/*Se agregan rutas para el formulario de CB */
Route::get('club/profile/{country}/{language}/email', 'incorporacionController@validateEmail');

Route::get('club/', 'incorporacionController@indexClub');
Route::get('club/profile/{country}/{language}/', 'incorporacionController@club');
Route::get('club/profile/{country}/{language}/municipality','incorporacionController@municipality');
Route::get('club/profile/{country}/{language}/searchsponsor','incorporacionController@searchsponsor');
Route::get('club/profile/{country}/{language}/searchsponsorValid','incorporacionController@searchsponsorValid');
Route::get('club/profile/{country}/{language}/banks','incorporacionController@getbanks');
Route::get('club/profile/{country}/{language}/gettypebankeacount','incorporacionController@gettypebankeacount');
Route::get('club/profile/{country}/{language}/states','incorporacionController@states');