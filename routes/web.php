<?php

use App\Http\Controllers\Admin\RegionController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;
use Spatie\FlareClient\View;
use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});


Auth::routes(['verify' => true]);

Route::middleware(['auth', 'isAdmin','verified'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home'); 
                      
    Route::get('user', [UserController::class, 'index'])->name('user');
    Route::get('user/add', [UserController::class, 'create'])->name('user.add');
    Route::post('user/store', [UserController::class, 'store'])->name('user.store');
    Route::get('user/list', [UserController::class, 'list'])->name('user.list');
    Route::get('user/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
    Route::post('user/update/{id}', [UserController::class, 'update'])->name('user.update');
    Route::delete('users/{id}', [UserController::class, 'delete'])->name('user.delete');

    Route::get('region', [RegionController::class, 'index'])->name('region');
    Route::get('region/add', [RegionController::class, 'create'])->name('region.add');
    Route::post('region/store', [RegionController::class, 'store'])->name('region.store');
    Route::get('region/list', [RegionController::class, 'list'])->name('region.list');
    Route::get('region/edit/{id}', [RegionController::class, 'edit'])->name('region.edit');
    Route::post('region/update/{id}', [RegionController::class, 'update'])->name('region.update');
    Route::delete('region/{id}', [RegionController::class, 'delete'])->name('region.delete');
});
