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

use app\http\controllers\admin\newscontroller;
use app\http\controllers\admin\profilecontroller;

Route::controller(NewsController::class)->prefix('admin')->group(function(){
   route::get('news/create', 'add') ;
});
Route::controller(ProfileController::class)->prefix('admin')->group(function(){
   route::get('profile/create', 'add') ;
   route::get('profile/edit', 'edit') ;
});