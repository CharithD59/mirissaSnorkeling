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

Route::get('/', 'App\Http\Controllers\PageController@home');

Route::get('view_booking_page', 'App\Http\Controllers\PageController@view_booking_page');
Route::get('send_contact_mail', 'App\Http\Controllers\PageController@send_contact_mail');
Route::get('send_booking_mail', 'App\Http\Controllers\PageController@send_booking_mail');
Route::POST('/log-whatsapp-click', 'App\Http\Controllers\PageController@logWhatsappClick');
Route::get('view_gallery_section', 'App\Http\Controllers\PageController@view_gallery_section');
Route::get('view_blue_whale_snorkeling', 'App\Http\Controllers\PageController@view_blue_whale_snorkeling');

/*
|--------------------------------------------------------------------------
| Admin Panel
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\Admin;

Route::prefix('admin')->name('admin.')->group(function () {

    Route::get('login', [Admin\AuthController::class, 'showLogin'])->name('login');
    Route::post('login', [Admin\AuthController::class, 'login'])->middleware('throttle:20,1')->name('login.submit');

    Route::middleware(['auth', 'admin.active'])->group(function () {
        Route::post('logout', [Admin\AuthController::class, 'logout'])->name('logout');

        Route::get('/', [Admin\DashboardController::class, 'index'])->name('dashboard');

        // Bookings
        Route::get('bookings/export', [Admin\BookingController::class, 'export'])->name('bookings.export');
        Route::patch('bookings/{booking}/status', [Admin\BookingController::class, 'updateStatus'])->name('bookings.status');
        Route::resource('bookings', Admin\BookingController::class);

        // Contact inquiries
        Route::get('inquiries', [Admin\InquiryController::class, 'index'])->name('inquiries.index');
        Route::get('inquiries/{inquiry}', [Admin\InquiryController::class, 'show'])->name('inquiries.show');
        Route::post('inquiries/{inquiry}/reply', [Admin\InquiryController::class, 'reply'])->name('inquiries.reply');
        Route::patch('inquiries/{inquiry}/status', [Admin\InquiryController::class, 'updateStatus'])->name('inquiries.status');
        Route::delete('inquiries/{inquiry}', [Admin\InquiryController::class, 'destroy'])->name('inquiries.destroy');

        // Packages
        Route::patch('packages/{package}/toggle', [Admin\PackageController::class, 'toggle'])->name('packages.toggle');
        Route::resource('packages', Admin\PackageController::class)->except(['show']);

        // Website content
        Route::get('content', [Admin\ContentController::class, 'index'])->name('content.index');
        Route::put('content/{group}', [Admin\ContentController::class, 'update'])->name('content.update');

        // Gallery
        Route::get('gallery', [Admin\GalleryController::class, 'index'])->name('gallery.index');
        Route::post('gallery', [Admin\GalleryController::class, 'store'])->name('gallery.store');
        Route::put('gallery/{image}', [Admin\GalleryController::class, 'update'])->name('gallery.update');
        Route::delete('gallery/{image}', [Admin\GalleryController::class, 'destroy'])->name('gallery.destroy');

        // Admin users & profile
        Route::get('profile', [Admin\UserController::class, 'profile'])->name('profile');
        Route::put('profile', [Admin\UserController::class, 'updateProfile'])->name('profile.update');
        Route::resource('users', Admin\UserController::class)->except(['show']);
    });
});
