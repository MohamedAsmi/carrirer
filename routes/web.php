<?php

use App\Http\Controllers\Admin\CsvMappingController;
use App\Http\Controllers\Admin\RegionController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\WeightOptionController;
use App\Http\Controllers\Admin\WeightPriceController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\UserSettingController;
use App\Http\Controllers\Admin\UserWeightPriceController;
use App\Http\Controllers\Auth\VerificationController;
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
    return redirect()->route('home');
});

Auth::routes(['verify' => true]);
Route::get('email/verify/success', [VerificationController::class, 'success'])->name('verification.success');
Route::get('email/verify/already-verified', [VerificationController::class, 'alreadyVerified'])->name('verification.already_verified');

Route::get('/home', [App\Http\Controllers\DashboardController::class, 'index'])->name('home');

Route::prefix('admin')->middleware(['auth', 'isAdmin', 'verified'])->group(function () {

    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.dashboard');

    Route::get('user', [UserController::class, 'index'])->name('user');
    Route::get('user/add', [UserController::class, 'create'])->name('user.add');
    Route::post('user/store', [UserController::class, 'store'])->name('user.store');
    Route::get('user/list', [UserController::class, 'list'])->name('user.list');
    Route::get('user/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
    Route::post('user/update/{id}', [UserController::class, 'update'])->name('user.update');
    Route::delete('users/{id}', [UserController::class, 'delete'])->name('user.delete');

    Route::get('user-settings/{user}', [UserSettingController::class, 'index'])->name('userSetting');
    Route::get('user-settings/{user_id}/get-child-setting-list/{parent_setting_id}', [UserSettingController::class, 'getChildSettingList'])->name('user-setting.getChildSettingList');
    Route::post('user-settings/update', [UserSettingController::class, 'update'])->name('user-setting.update');

    Route::get('region/list', [RegionController::class, 'list'])->name('region.list');
    Route::resource('region', RegionController::class);

    Route::get('csv-mapping/upload', [CsvMappingController::class, 'index'])->name('csv-mapping.index');
    Route::post('csv-mapping/upload', [CsvMappingController::class, 'csvUpload'])->name('csv-mapping.upload');
    Route::get('csv-mapping/{user_id}', [CsvMappingController::class, 'mapCsv'])->name('csv-mapping.map-csv');
    Route::post('csv-mapping/{user_id}/update', [CsvMappingController::class, 'update'])->name('csv-mapping.update');

    Route::get('weight-option/list', [WeightoptionController::class, 'list'])->name('weightoption.list');
    Route::resource('weight-option', WeightOptionController::class);

    Route::get('weight-price/list', [WeightPriceController::class, 'list'])->name('weightprice.list');
    Route::resource('weight-price', WeightPriceController::class);

    Route::get('user-weight-price/list', [UserWeightPriceController::class, 'list'])->name('user-weight-price.list');
    Route::resource('user-weight-price', UserWeightPriceController::class);

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
