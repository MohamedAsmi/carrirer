<?php

use App\Http\Controllers\Admin\RegionController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\WeightOptionController;
use App\Http\Controllers\Admin\WeightPriceController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\UserSettingController;
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

Route::prefix('admin')->middleware(['auth', 'isAdmin', 'verified'])->group(function () {

    Route::get('user', [UserController::class, 'index'])->name('user');
    Route::get('user/add', [UserController::class, 'create'])->name('user.add');
    Route::post('user/store', [UserController::class, 'store'])->name('user.store');
    Route::get('user/list', [UserController::class, 'list'])->name('user.list');
    Route::get('user/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
    Route::post('user/update/{id}', [UserController::class, 'update'])->name('user.update');
    Route::delete('users/{id}', [UserController::class, 'delete'])->name('user.delete');

    Route::get('user-settings/{user}', [UserSettingController::class, 'index'])->name('userSetting');
    Route::get('user-settings/{parent_setting_id}/get-child-setting-list', [UserSettingController::class, 'getChildSettingList'])->name('user-setting.getChildSettingList');
    Route::post('user-settings/update', [UserSettingController::class, 'update'])->name('user-setting.update');

    Route::get('region/list', [RegionController::class, 'list'])->name('region.list');
    Route::resource('region', RegionController::class);

    Route::get('weight-option/list', [WeightoptionController::class, 'list'])->name('weightoption.list');
    Route::resource('weight-option', WeightOptionController::class);

    Route::get('weight-price/list', [WeightPriceController::class, 'list'])->name('weightprice.list');
    Route::resource('weight-price', WeightPriceController::class);

    Route::get('setting/list', [SettingController::class, 'list'])->name('setting.list');
    Route::resource('setting', SettingController::class);
    Route::group(['prefix' => 'setting'], function () {
        Route::get('{setting}/child-setting', [SettingController::class, 'showChildSettings'])
            ->name('settings.child-setting');
        Route::get('{setting}/child-setting/list', [SettingController::class, 'listChildSettings'])
            ->name('settings.child-setting.list');
        Route::get('{parent_id}/child-setting/create', [SettingController::class, 'createChildSetting'])
            ->name('setting.child-setting.create');
        Route::post('{setting}/child-setting', [SettingController::class, 'storeChildSetting'])
            ->name('settings.child-setting.store');
        Route::get('{setting_parent}/child-setting/{setting}', [SettingController::class, 'editChildSetting'])
            ->name('settings.child-setting.edit');
        Route::put('{setting}/child-setting/{child}', [SettingController::class, 'updateChildSetting'])
            ->name('settings.child-setting.update');
        Route::delete('{setting}/child-setting/{child}', [SettingController::class, 'destroyChildSetting'])
            ->name('settings.child-setting.destroy');
    });
});
