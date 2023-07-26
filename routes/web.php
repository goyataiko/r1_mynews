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
   
   route::get('news/edit', 'edit')->name('news.edit');
   route::post('news/edit', 'update')->name('news.update');
   
      route::get('news/delete', 'delete')->name('news.delete');

});


Route::controller(ProfileController::class)->prefix('admin')->name('admin.')->middleware('auth')->group(function(){
   route::get('profile', 'index')->name('profile.index');
   
   route::get('profile/create', 'add')->name('profile.add');
   route::post('profile/create', 'create')->name('profile.create');

   route::get('profile/edit', 'edit')->name('profile.edit');
   route::post('profile/edit', 'update')->name('profile.update');
   
   route::get('profile/delete', 'delete')->name('profile.delete');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
