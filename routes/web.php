<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;

Route::get('/', function(){
    if (auth()->check()) {
        return redirect()->route('profile.index', ['username' => auth()->user()->username]);
    }
    return redirect()->route('login.index');
});

Route::get('/register', [registerController::class, 'create'])->name('register.index');
Route::post('/register', [registerController::class,'store'])->name('register.store');
Route::get('/login', [loginController::class, 'index'])->name('login.index');
Route::post('/login', [loginController::class, 'process'])->name('login.process');

Route::group(['prefix'=>'{username}','middleware'=>['auth','check.name'],'as'=>'profile.'], function(){
    Route::get('/', [profileController::class, 'index'])->name('index');
    Route::match(['get', 'put'], '/update', [profileController::class, 'update'])->name('update');
    Route::post('/logout', [profileController::class, 'logout'])->name('logout');
    Route::get('/create-post', [profileController::class, 'createPost'])->name('create-post');
});

Route::fallback(function() {
    return redirect('/');
});

    //Route::get('/', [profileController::class, 'friend'])->name('friend.index');
// Route::group(['prefix'=>'{username}','middleware'=>['auth','can:access-profile'],'as'=>'profile.'], function(){
//     Route::get('/', [profileController::class, 'index'])->name('index');
//     Route::match(['get', 'put'], '/update', [profileController::class, 'update'])->name('update');
//     Route::post('/logout', [profileController::class, 'logout'])->name('logout');
// });