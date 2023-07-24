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

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\ProfileController;

Route::controller(NewsController::class)->prefix('admin')->group(function(){
   route::get('news/create', 'add') ;
});

Route::controller(ProfileController::class)->prefix('admin')->group(function(){
   route::get('profile/create', 'add') ;
   route::get('profile/edit', 'edit') ;
});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
