<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\EmailsController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LocalizationController;
use App\Http\Controllers\TestEnrollmentController;
use App\Mail\desire;
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
  // Route::get('/home', [App\Http\Controllers\AdminController::class, 'showDashboard'])->name('dashboard');
});
  Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');



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


//success state 
Route::post("/success/{id}", [App\Http\Controllers\RealestateController::class, 'success'])->name('success');


//all users
Route::get("/users", [App\Http\Controllers\UserController::class, 'users'])->name('users');

//delete user
Route::delete("/user/{id}", [App\Http\Controllers\UserController::class, 'destroy'])->name('delete-user');



/* view composer */
View::composer(['*','layouts.app','details'],function($view)
{
  $user = Auth::user();
  $view->with('user',$user);
});



//Localization Route
Route::get("locale/{lange}", [LocalizationController::class, 'setLang'])->name('lang');


// Auth::routes();



Route::get("/zana", [App\Http\Controllers\SubscriptionController::class, 'index']);


//Route for mailing

// Route::get('/email',function(){
//   Mail::to('LinaSoleman63@gmail.com')->send( new desire());
//   return new desire();
// });


// Route::get("/email", [App\Http\Controllers\EmailsController::class, 'email']);

// Route::get("/send-notification", [App\Http\Controllers\TestEnrollmentController::class, 'sendTestNotification']);


Route::get('send-mail', function () {
   
  $details = [
      'title' => 'Mail from ItSolutionStuff.com',
      'body' => 'This is for testing email using smtp'
  ];
 
  Mail::to('LinaSoleman63@gmail.com')->send(new \App\Mail\AttachmentMail($details));
 
  dd("Email is Sent.");
});




