<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;


Route::group(['prefix' => 'user','middleware' =>  'userMiddleware'], function () {

    // Route::get('home', function () {
    //     return view('user.home');
    // })->name('user#homePage');
    Route::get('home',[UserController::class,'home'])->name('user#homePage');
    Route::get('product/details/{id}',[UserController::class,'productDetails'])->name('user#productDetails');
    Route::post('comment', [UserController::class, 'comment'])->name('user#comment');
    Route::get('comment/delete/{id}', [UserController::class, 'commentDelete'])->name('user#commentDelete');
    Route::post('rating', [UserController::class, 'rating'])->name('user#rating');
    Route::get('cart', [UserController::class, 'cart'])->name('user#cart');
    Route::post('addToCart', [UserController::class, 'addToCart'])->name('user#addToCart');
    Route::get('cardDelete', [UserController::class, 'cardDelete'])->name('user#cardDelete');//api call write
    Route::get('tempStorage', [UserController::class, 'tempStorage'])->name('user#tempStorage');//api
    Route::get('paymentPage', [UserController::class, 'paymentPage'])->name('user#paymentPage');
    Route::post('order', [UserController::class, 'order'])->name('user#order');
    Route::get('orderList', [UserController::class, 'orderList'])->name('user#orderList');
    Route::get('profile', [UserController::class, 'profile']) ->name('user#profile');
    Route::post('profile/update', [UserController::class, 'updateProfile'])->name('user#updateProfile');
    Route::get('change/password',[UserController::class,'changePasswordPage'])->name('user#changePasswordPage');
    Route::post('change/password',[UserController::class,'changePassword'])->name('user#changePassword');
    Route::get('contact', [UserController::class, 'contactPage'])->name('user#contactPage');
    Route::post('contact', [UserController::class, 'contact'])->name('user#contact');
    Route::get('privacyPolicy', [UserController::class, 'privacyPolicy'])->name('user#privacyPolicy');
    Route::get('termsConditions', [UserController::class, 'termsConditions'])->name('user#termsConditions');
});
