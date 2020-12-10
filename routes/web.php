<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
    if(Auth::check()){
        return redirect()->intended("home");
    }
    return view('login');
})->name('/');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => '/clientes'], function () {
    Route::match(['get', 'post'], '', 'ClientesController@index')->name('clientes');
    Route::post('/agregar', 'ClientesController@nuevo')->name('clientes.agregar');
    Route::post('/editar', 'ClientesController@editar')->name('clientes.editar');
    Route::post('/eliminar', 'ClientesController@eliminar')->name('clientes.eliminar');
    Route::post('/{id}', 'ClientesController@buscar')->name('clientes.buscar');
});