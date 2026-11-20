<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SocialLoginController;

require_once __DIR__.'/admin.php';
require_once __DIR__.'/user.php';

//Social login

// Route::get('/', function () {
//     return view('welcome');
// });
//when  local host runs,reach login page
Route::redirect('/','login');

Route::get('/dashboard', function () {
    // return view('dashboard');
    return view('authentication.login');
    
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//auth/github/redirect
//auth/google/redirect
//auth/facebook/redirect
Route::get('/auth/{provider}/redirect',[SocialLoginController::class,'redirect'])->name('socialLogin');



Route::get('/auth/{provider}/callback', [SocialLoginController::class,'callback'])->name('socialCallback');



require __DIR__.'/auth.php';
