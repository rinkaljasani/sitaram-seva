<?php

use App\Http\Controllers\Web\CategoryController;
use App\Http\Controllers\Web\DonateController;
use App\Http\Controllers\Web\EventController;
use App\Http\Controllers\Web\TeamController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;
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

// main routes for  website
Route::get('/','FrontendPagesController@index')->name('index');
// Route::get('/index','FrontendPagesController@index')->name('index');
Route::get('/how-it-works','FrontendPagesController@howItsWork')->name('how-its-work');

Route::get('/gallery/image','FrontendPagesController@imageGallery')->name('gallery.image');
Route::get('/gallery/video','FrontendPagesController@videoGallery')->name('gallery.video');
Route::get('/about','FrontendPagesController@about')->name('about');
Route::get('/blog','FrontendPagesController@blog')->name('blog');

Route::get('/contact','FrontendPagesController@contact')->name('contact');

// donte
Route::get('/donates',[DonateController::class,'index'])->name('donates.index');
Route::post('/donates',[DonateController::class,'store'])->name('donates.store');

// category
Route::get('/category',[CategoryController::class,'index'])->name('category.index');
Route::get('/category/{category}',[CategoryController::class,'show'])->name('category.show');

// event
Route::get('/event',[EventController::class,'index'])->name('event.index');
Route::get('/event/{event}',[EventController::class,'show'])->name('event.show');

// volunteer
Route::get('/volunteer',[TeamController::class,'index'])->name('team.index');
Route::post('/volunteer',[TeamController::class,'store'])->name('team.store');

Auth::routes(['register' => false, 'login' => false]);

Route::get('login', 'AdminAuth\LoginController@showLoginForm')->name('login');

// /* CMS Pages */
  Route::get('about-us', 'FrontendPagesController@about')->name('about.us');
  Route::get('terms-and-conditions', 'FrontendPagesController@terms')->name('terms');
  Route::get('privacy-policy', 'FrontendPagesController@privacy')->name('privacy.policy');
    
Route::group(['prefix' => 'admin'], function () {
  Route::get('login', 'AdminAuth\LoginController@showLoginForm')->name('admin.login');
  Route::post('login', 'AdminAuth\LoginController@login');
  Route::get('logout', 'AdminAuth\LoginController@logout')->name('admin.logout');

  Route::post('/password/email', 'AdminAuth\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.request');
  Route::post('/password/reset', 'AdminAuth\ResetPasswordController@reset')->name('admin.password.email');
  Route::get('/password/reset', 'AdminAuth\ForgotPasswordController@showLinkRequestForm')->name('admin.password.reset');
  Route::get('/password/reset/{token}/{email?}', 'AdminAuth\ResetPasswordController@showResetForm');
});
// Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::group(['prefix' => 'admin'], function () {
//   Route::get('/login', 'AdminAuth\LoginController@showLoginForm')->name('login');
//   Route::post('/login', 'AdminAuth\LoginController@login');
//   Route::post('/logout', 'AdminAuth\LoginController@logout')->name('logout');

//   Route::get('/register', 'AdminAuth\RegisterController@showRegistrationForm')->name('register');
//   Route::post('/register', 'AdminAuth\RegisterController@register');

//   Route::post('/password/email', 'AdminAuth\ForgotPasswordController@sendResetLinkEmail')->name('password.request');
//   Route::post('/password/reset', 'AdminAuth\ResetPasswordController@reset')->name('password.email');
//   Route::get('/password/reset', 'AdminAuth\ForgotPasswordController@showLinkRequestForm')->name('password.reset');
//   Route::get('/password/reset/{token}', 'AdminAuth\ResetPasswordController@showResetForm');
// });

// Route::group(['prefix' => 'dealer'], function () {
//   Route::get('/login', 'DealerAuth\LoginController@showLoginForm')->name('login');
//   Route::post('/login', 'DealerAuth\LoginController@login');
//   Route::post('/logout', 'DealerAuth\LoginController@logout')->name('logout');

//   Route::get('/register', 'DealerAuth\RegisterController@showRegistrationForm')->name('register');
//   Route::post('/register', 'DealerAuth\RegisterController@register');

//   Route::post('/password/email', 'DealerAuth\ForgotPasswordController@sendResetLinkEmail')->name('password.request');
//   Route::post('/password/reset', 'DealerAuth\ResetPasswordController@reset')->name('password.email');
//   Route::get('/password/reset', 'DealerAuth\ForgotPasswordController@showLinkRequestForm')->name('password.reset');
//   Route::get('/password/reset/{token}', 'DealerAuth\ResetPasswordController@showResetForm');
// });
