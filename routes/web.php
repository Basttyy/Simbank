<?php

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
    return view('welcome');
});

Auth::routes();

Route::resources([
    'category' => 'CategoryController',
    'commands' => 'CommandController',
    'command_histories' => 'CommandHistoryController',
    'sim_slots' => 'SimSlotController'
]);

Route::get('/sim_slots/{sim_slot}/delete', 'SimSlotController@destroy')->name('sim_slots.delete');
Route::get('/commands/{command}/delete', 'CommandController@destroy')->name('commands.delete');
Route::post('commands/{command}/execute', 'CommandController@execute')->name('commands.execute');
Route::get('/command_histories/{command_history}/delete', 'CommandHistoryController@destroy')->name('command_histories.delete');
Route::get('/categories/{category}/delete', 'CategoryController@destroy')->name('categories.delete');

Route::get('/home', 'HomeController@index')->name('home');
