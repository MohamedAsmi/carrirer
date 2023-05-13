<?php

use App\Http\Controllers\Admin\RegionController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\WeightoptionController;
use App\Http\Controllers\Admin\WeightpriceController;
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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('admin/region/list', [RegionController::class, 'list'])->name('region.list'); // TODO: needs to moved into admin route group
Route::get('admin/setting/list', [SettingController::class, 'list'])->name('setting.list'); // TODO: needs to moved into admin route group
Route::get('admin/weightoption/list', [WeightoptionController::class, 'list'])->name('weightoption.list'); // TODO: needs to moved into admin route group
Route::get('admin/weightprice/list', [WeightpriceController::class, 'list'])->name('weightprice.list'); // TODO: needs to moved into admin route group

Route::prefix('admin')->middleware(['auth', 'isAdmin', 'verified'])->group(function () {

    Route::get('user', [UserController::class, 'index'])->name('user');
    Route::get('user/add', [UserController::class, 'create'])->name('user.add');
    Route::post('user/store', [UserController::class, 'store'])->name('user.store');
    Route::get('user/list', [UserController::class, 'list'])->name('user.list');
    Route::get('user/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
    Route::post('user/update/{id}', [UserController::class, 'update'])->name('user.update');
    Route::delete('users/{id}', [UserController::class, 'delete'])->name('user.delete');

    Route::get('region/list', [RegionController::class, 'list'])->name('region.list');
    Route::resource('region', RegionController::class);
    // Route::get('region', [RegionController::class, 'index'])->name('region');
    // Route::get('region/add', [RegionController::class, 'create'])->name('region.add');
    // Route::post('region/store', [RegionController::class, 'store'])->name('region.store');
    Route::get('region/list', [RegionController::class, 'list'])->name('region.list');
    // Route::get('region/edit/{id}', [RegionController::class, 'edit'])->name('region.edit');
    // Route::post('region/update/{id}', [RegionController::class, 'update'])->name('region.update');
    // Route::delete('region/{id}', [RegionController::class, 'delete'])->name('region.delete');

    Route::resource('setting', SettingController::class);
    Route::resource('weightoption', WeightoptionController::class);
    Route::resource('weightprice', WeightpriceController::class);
    // Route::get('setting', [SettingController::class, 'index'])->name('setting.index');
    // Route::get('setting/create', [SettingController::class, 'create'])->name('setting.create');
    // Route::post('setting/store', [SettingController::class, 'store'])->name('setting.store');
    Route::get('setting/list', [SettingController::class, 'list'])->name('setting.list');
    // Route::get('setting/{setting}/edit', [SettingController::class, 'edit'])->name('setting.edit');
    // Route::post('setting/update/{id}', [SettingController::class, 'update'])->name('setting.update');
    // Route::delete('setting/{setting}', [SettingController::class, 'delete'])->name('setting.destroy');

    Route::group(['prefix' => 'settings'], function () {
        Route::get('{setting}/child-setting', [SettingController::class, 'showChildSettings'])
            ->name('settings.child-setting');
        Route::get('{setting}/child-setting/list', [SettingController::class, 'listChildSettings'])
            ->name('settings.child-setting.list');
        Route::get('{setting}/child-setting/create', [SettingController::class, 'createChildSetting'])
            ->name('settings.child-setting.create');
        Route::post('{setting}/child-setting', [SettingController::class, 'storeChildSetting'])
            ->name('settings.child-setting.store');
        Route::get('{setting}/child-setting/{child}', [SettingController::class, 'editChildSetting'])
            ->name('settings.child-setting.edit');
        Route::put('{setting}/child-setting/{child}', [SettingController::class, 'updateChildSetting'])
            ->name('settings.child-setting.update');
        Route::delete('{setting}/child-setting/{child}', [SettingController::class, 'destroyChildSetting'])
            ->name('settings.child-setting.destroy');

        
        Route::get('weightoption/edit/{id}', [WeightoptionController::class, 'edit'])
            ->name('weightoption.edit');
        Route::delete('weightoption/delete/{id}', [WeightoptionController::class, 'destroy'])
            ->name('weightoption.destroy');
        Route::post('weightoption/update/{id}', [WeightoptionController::class, 'update'])
            ->name('weightoption.update');

            
        Route::get('weightprice/edit/{id}', [WeightpriceController::class, 'edit'])
            ->name('weightprice.edit');
        Route::delete('weightprice/delete/{id}', [WeightpriceController::class, 'destroy'])
            ->name('weightprice.destroy');
        Route::post('weightprice/update/{id}', [WeightpriceController::class, 'update'])
            ->name('weightprice.update');
        
    });
});
