<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
// use  App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

 Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
     return $request->user();
 });

Route::post("/login",[App\Http\Controllers\UserController::class,'index']);

//-------------------------------anas-------------------------------------------------------------
Route::post('/login', [AuthController::class,'index']);


// Route::post('/login', 'App\Http\Controllers\API\AuthController@login');
Route::post('/register', 'App\Http\Controllers\API\AuthController@register');

Route::middleware('auth:sanctum')->group( function (){

    Route::post('/Add', 'App\Http\Controllers\API\RealestateController@store');
    Route::get('/Add', 'App\Http\Controllers\API\RealestateController@cities');
    Route::get('/show', 'App\Http\Controllers\API\RealestateController@show');
    Route::post('/edit/{id}', 'App\Http\Controllers\API\RealestateController@update');
    Route::get('/details/{id}', 'App\Http\Controllers\API\RealestateController@details');
    Route::get('/yourReal/{id}', 'App\Http\Controllers\API\RealestateController@yourReal');
    Route::delete('/delete/{id}', 'App\Http\Controllers\API\RealestateController@destroy');


    // Route::post('/search', 'App\Http\Controllers\API\SearchController@search');
    // Route::get('/search', 'App\Http\Controllers\API\SearchController@search');

Route::get("/search", [App\Http\Controllers\API\SearchController::class, 'result']);



    Route::get('/favoraite', 'App\Http\Controllers\API\FavoraiteController@show');
    Route::post('/favoraite/{id}', 'App\Http\Controllers\API\FavoraiteController@store');
    Route::delete('/favoraite/{id}', 'App\Http\Controllers\API\FavoraiteController@destroy');

    Route::post('/desire', 'App\Http\Controllers\API\DesireController@store');

    Route::get('/reserve', 'App\Http\Controllers\API\ReserveController@show');
    Route::post('/reserve/{id}', 'App\Http\Controllers\API\ReserveController@store');
    Route::delete('/reserve/{id}', 'App\Http\Controllers\API\ReserveController@destroy');


});
