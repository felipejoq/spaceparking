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

use Illuminate\Support\Facades\Auth;

//Rutas para las vistas públicas
Route::get('/', function () {
    return view('index');
})->name('index');

Route::get('nosotros', 'NosotrosController@index')->name('nosotros');


// Authentication Routes...
$this->get('login', 'Auth\LoginController@showLoginForm')->name('login');
$this->post('login', 'Auth\LoginController@login');
$this->post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
$this->get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
$this->post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
$this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
$this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
$this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
$this->post('password/reset', 'Auth\ResetPasswordController@reset');

Route::group(['prefix' => 'admin', 'middleware' => 'auth'],function (){

    Route::get('/', 'HomeController@index')->name('admin');

    //Rutas Para la vista plazas
    Route::resource('nodemcu', 'Nodemcu\NodemcuController',['except' => ['create','edit']]);
    Route::resource('plazas', 'Plaza\PlazaController',['except' => ['create','edit']]);

     //Recurso para los tipos de plazas
    Route::resource('tipos','Tipo\TipoPlazaController');

    //Recurso para estacionamiento
    Route::resource('estacionamiento','Estacionamiento\EstacionamientoController');

});
