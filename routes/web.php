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

Route::controller(NewsController::class)->prefix('admin')->name('admin.')->middleware('auth')->group(function(){
   
   route::get('news', 'index')-> name('news.index');
   
   route::get('news/create', 'add')->name('news.add');
   route::post('news/create', 'create')->name('news.create');
});


Route::controller(ProfileController::class)->prefix('admin')->name('admin.')->middleware('auth')->group(function(){
   route::get('profile/create', 'add')->name('profile.create');
   route::post('profile/create', 'create')->name('profile.create');

   route::get('profile/edit', 'edit')->name('profile.edit');
   route::post('profile/edit', 'update')->name('profile.edit');
});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
