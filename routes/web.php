<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LocalizationController;
//  use App\Http\Controllers\PostController;

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
  //   // Alert::success('Success Title', 'Success Message');
  //   // alert()->info('InfoAlert','Lorem ipsum dolor sit amet.');

  //     return view('auth/register');
  // })->name('register');


//dashboard Admin
Route::middleware(['auth','isAdmin'])->group(function (){
  Route::get('/home', [App\Http\Controllers\AdminController::class, 'showDashboard'])->name('dashboard');
});



  Route::get('/', function () {
    return view('auth.register');
});

//search route
  
Route::get("/search-real", [App\Http\Controllers\SearchController::class, 'search'])->name('search');
Route::get("/search", [App\Http\Controllers\SearchController::class, 'result'])->name('result');

//count real favoraite
// Route::get("/countRealFav/{id}", [App\Http\Controllers\FavoraiteController::class, 'numberReaFavoraite'])->name('edit-realestate');

//show Route
Route::get("/show", [App\Http\Controllers\ViewsController::class, 'index'])->name('show');



Auth::routes();

//Add Realestate Routes
Route::get("/Add", [App\Http\Controllers\RealestateController::class, 'create'])->name('Add-realestate');
Route::post("/Add", [App\Http\Controllers\RealestateController::class, 'store'])->name('store-realestate');





//Edit realestate Routes
Route::get("/edit/{id}", [App\Http\Controllers\RealestateController::class, 'edit'])->name('edit-realestate');
Route::put("/edit/{id}", [App\Http\Controllers\RealestateController::class, 'update'])->name('update-realestate');


// your Real
Route::get("/yourReal/{id}", [App\Http\Controllers\ViewsController::class, 'yourReal'])->name('your_real');


//details view
Route::get("/details/{id}", [App\Http\Controllers\ViewsController::class, 'details'])->name('details');




//Add Desire Routes
Route::get("/desire", [App\Http\Controllers\DesireController::class, 'create'])->name('Add-desire');
Route::post("/desire", [App\Http\Controllers\DesireController::class, 'store'])->name('store-desire');


//favoraite Route
Route::get("liked/{id}", [App\Http\Controllers\FavoraiteController::class, 'like']);


Route::get("/favoraite", [App\Http\Controllers\FavoraiteController::class, 'index'])->name('favoraite-show');


//Reserve Route
Route::get("reserve/{id}", [App\Http\Controllers\ReserveController::class, 'reserve']);

Route::get("/reserve", [App\Http\Controllers\ReserveController::class, 'index'])->name('reserve-show');


//delete 
Route::delete("/delete/{id}", [App\Http\Controllers\RealestateController::class, 'destroy'])->name('delete');


//delete 
Route::delete("/deletefav/{id}", [App\Http\Controllers\FavoraiteController::class, 'destroy'])->name('delete-favoraite');


/* view composer */
View::composer(['*','layouts.app','details'],function($view)
{
  $user = Auth::user();
  $view->with('user',$user);
});


//display image store
// Route::get('storage/app/images/loloo_4_07-04-22_15_50_04/{filename}', 'ViewsControllers@getPubliclyStorgeFile')->name('displayImage');


//chartjs
// Route::get('/test2', [ App\Http\Controllers\PostController::class, 'getMonthlyPostData']);

//Localization Route
Route::get("locale/{lange}", [LocalizationController::class, 'setLang']);


// Auth::routes();



Route::get("/zana", [App\Http\Controllers\SubscriptionController::class, 'index']);

// Route::get('/{page}', [AdminController::class, 'index']);





