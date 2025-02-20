<?php


use App\Http\Controllers\SiteController;
use App\Http\Controllers\HomelandController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReviewController;

/*Route::get('/', function () {
    return view('welcome');
});*/


/*
Route::get('/', [SiteController::class, 'index']);
Route::get('/about', [SiteController::class, 'about']);
Route::get('/contact', [SiteController::class, 'contact']);
Route::get('/services', [SiteController::class, 'services']);
*/

Route::get('/', [HomelandController::class, 'index'])->name('home');
Route::match(['get', 'post'], '/property_details/{property_id}', [HomelandController::class, 'property_details'])->name('property_details');
Route::get('/buy', [HomelandController::class, 'buy'])->name('buy');
Route::get('/rent', [HomelandController::class, 'rent'])->name('rent');
Route::get('/properties{property_type_id}', [HomelandController::class, 'properties'])->name('property_listing_type');
Route::get('/about', [HomelandController::class, 'about'])->name('about');
Route::match(['get', 'post'], '/contact', [HomelandController::class, 'contact'])->name('contact');
Route::get('/login', [HomelandController::class, 'login'])->name('login');
Route::get('/register', [HomelandController::class, 'register'])->name('register');
Route::match(['get', 'post'], '/property/{id}/review', [ReviewController::class, 'store'])->name('property.review.store');
