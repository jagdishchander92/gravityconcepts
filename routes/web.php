<?php

use App\Http\Controllers\FrontendController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('frontend.page.page');
// });
Route::get('/', [FrontendController::class, 'page']);
// Route::get('/', [FrontendController::class, 'page']);
Route::get('/category/{slug}', [FrontendController::class, 'blogByCategory']);
Route::get('blogs', [FrontendController::class, 'blogsList']);
Route::get('/blog/{slug}', [FrontendController::class, 'showBlog']);
Route::get('/contact-us', [FrontendController::class, 'contactUs']);
Route::post('/contact-us-post', [FrontendController::class, 'contactForm'])->name('contact.store');
Route::post('/store-comment', [FrontendController::class, 'storeComment'])->name('comments.store');
Route::get('/{any}', [FrontendController::class, 'page'])->where('any', '.*');
