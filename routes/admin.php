<?php

use App\Http\Controllers\Admin\ErrorController;
use App\Http\Controllers\Admin\Pages\AddressController;
use App\Http\Controllers\Admin\Pages\AdminController;
use App\Http\Controllers\Admin\Pages\CategoryController;
use App\Http\Controllers\Admin\Pages\CityController;
use App\Http\Controllers\Admin\Pages\CmsPagesController;
use App\Http\Controllers\Admin\Pages\CountryController;
use App\Http\Controllers\Admin\Pages\DonationController;
use App\Http\Controllers\Admin\Pages\EventController;
use App\Http\Controllers\Admin\Pages\FaqController;
use App\Http\Controllers\Admin\Pages\GalleriesController;
use App\Http\Controllers\Admin\Pages\PagesController;
use App\Http\Controllers\Admin\Pages\StateController;
use App\Http\Controllers\Admin\Pages\UsersController;
use App\Http\Controllers\Admin\Pages\VolunteerController;
use App\Http\Controllers\UtilityController;
use Illuminate\Support\Facades\Route;


Route::group(['middleware' => ['revalidate']], function () {
	Route::get('/home', function () {
		return redirect(route('admin.dashboard.index'));
	})->name('home');

	// // Profile
	Route::get('profile/', [PagesController::class,'profile'])->name('profile-view');
	Route::post('profile/update', [PagesController::class,'updateProfile'])->name('profile.update');
	Route::put('change/password', [PagesController::class,'updatePassword'])->name('update-password');

});

Route::group(['middleware' => ['check_permit', 'revalidate']], function () {

	/* Dashboard */
	Route::get('/', [PagesController::class, 'dashboard'])->name('dashboard.index');
	Route::get('/dashboard', [PagesController::class, 'dashboard'])->name('dashboard.index');

	// /* User */
	Route::get('users/listing', [UsersController::class, 'listing'])->name('users.listing');
	Route::resource('users', UsersController::class);

	// /* User */
	Route::get('gallery/listing', [GalleriesController::class, 'listing'])->name('gallery.listing');
	Route::resource('gallery', GalleriesController::class);

	// /* Role Management */
	Route::get('roles/listing', [AdminController::class, 'listing'])->name('roles.listing');
	Route::resource('roles', AdminController::class);

	/* Faqs*/
	Route::get('faqs/listing', [FaqController::class,'listing'])->name('faqs.listing');
	Route::resource('faqs', FaqController::class);

	// /* CMS Management*/
	Route::get('pages/listing', [CmsPagesController::class,'listing'])->name('pages.listing');
	Route::resource('pages', CmsPagesController::class);

	/* Site Configuration */
	Route::get('settings', [PagesController::class,'showSetting'])->name('settings.index');
	Route::post('change-setting', [PagesController::class,'changeSetting'])->name('settings.change-setting');

	/* Country Management */
	Route::get('countries/listing', [CountryController::class,'listing'])->name('countries.listing');
	Route::resource('countries', CountryController::class);

	/* State Management */
	Route::get('states/listing', [StateController::class,'listing'])->name('states.listing');
	Route::resource('states', StateController::class);

	/* City Management */
	Route::get('cities/listing', [CityController::class,'listing'])->name('cities.listing');
	Route::resource('cities', CityController::class);
	
	/* Address Management */
	Route::get('addresses/listing', [AddressController::class,'listing'])->name('addresses.listing');
	Route::resource('addresses', AddressController::class);
	
	/* Category Management */
	Route::get('categories/listing', [CategoryController::class,'listing'])->name('categories.listing');
	Route::resource('categories', CategoryController::class);

	/* Event Management */
	Route::get('events/listing', [EventController::class,'listing'])->name('events.listing');
	Route::resource('events', EventController::class);

	/* Donation Management */
	Route::get('donations/listing', [DonationController::class,'listing'])->name('donations.listing');
	Route::resource('donations', DonationController::class);

	/* Volunteer Management */
	Route::get('volunteers/listing', [VolunteerController::class,'listing'])->name('volunteers.listing');
	Route::resource('volunteers', VolunteerController::class);
});

// //User Exception
Route::get('users-error-listing', [ErrorController::class,'listing'])->name('error.listing');

Route::post('check-email', [UtilityController::class,'checkEmail'])->name('check.email');
Route::post('check-contact', [UtilityController::class,'checkContact'])->name('check.contact');

Route::post('check-title', [UtilityController::class,'checkTitle'])->name('check.title');
Route::post('profile/check-password', [UtilityController::class,'profilecheckpassword'])->name('profile.check-password');
