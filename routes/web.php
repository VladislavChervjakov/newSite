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
    return redirect()->route('dashboard');
});

Route::group(['namespace' => 'App\Http\Controllers'], function () {
    Route::resource('news', 'NewsController')->names('news')
            ->middleware(['auth']);
    Route::resource('categories', 'CategoriesController')
        ->names('categories')
        ->middleware('is_admin');

});

Route::get('/dashboard', [\App\Http\Controllers\UserController::class, 'index'])
    ->middleware(['auth'])->name('dashboard');



//Route::get('/dashboard', function () {
//    return view('dashboard');
//})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Auth::routes();

//Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
