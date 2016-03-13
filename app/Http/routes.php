<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::get('/',function(){
  return redirect('pegawai');
});

Route::group(['prefix'=>'pegawai'],function(){

  Route::get('','PegawaiController@index');
  Route::post('','PegawaiController@store');
  Route::get('{id}','PegawaiController@show');
  Route::post('update','PegawaiController@update');
  Route::post('destroy','PegawaiController@destroy');

});
Route::get('tes1','TesController@index');
Route::get('tes2','TesController@index2');
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    //
});
