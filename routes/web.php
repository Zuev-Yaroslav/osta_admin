<?php

use Illuminate\Support\Facades\Route;

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
    return redirect()->route('admin.index');
});

Route::group(['prefix' => '/auth'], function() {
    Route::group(['middleware' => 'auth'], function() {
        Route::post('/logout', \App\Http\Controllers\Auth\LogoutController::class)->name('auth.logout');
    });
    Route::group(['middleware' => 'guest'], function() {
        Route::get('/login', [\App\Http\Controllers\Auth\LoginController::class, 'index'])->name('auth.login');
        Route::post('/login', [\App\Http\Controllers\Auth\LoginController::class, 'store']);
    });
});

Route::group(['prefix' => '/admin', 'middleware' => 'admin'], function() {
    Route::get('/', \App\Http\Controllers\Admin\IndexController::class)->name('admin.index');
    Route::group(['prefix' => '/events'], function() {
        Route::get('/', [\App\Http\Controllers\Admin\Event\EventController::class, 'index'])->name('admin.event.index');
        Route::get('/create', [\App\Http\Controllers\Admin\Event\EventController::class, 'create'])->name('admin.event.create');
        Route::get('/{event}', [\App\Http\Controllers\Admin\Event\EventController::class, 'edit'])->name('admin.event.edit');

        Route::post('/', \App\Http\Controllers\Admin\Event\StoreController::class)->name('admin.event.store');
        Route::put('/{event}', \App\Http\Controllers\Admin\Event\UpdateController::class)->name('admin.event.update');
        Route::delete('/{event}', \App\Http\Controllers\Admin\Event\DeleteController::class)->name('admin.event.delete');
    });
    Route::group(['prefix' => '/buildings'], function() {
        Route::get('/', [\App\Http\Controllers\Admin\Building\BuildingController::class, 'index'])->name('admin.building.index');
        Route::get('/create', [\App\Http\Controllers\Admin\Building\BuildingController::class, 'create'])->name('admin.building.create');
        Route::get('/{building}', [\App\Http\Controllers\Admin\Building\BuildingController::class, 'edit'])->name('admin.building.edit');

        Route::post('/', \App\Http\Controllers\Admin\Building\StoreController::class)->name('admin.building.store');
        Route::put('/{building}', \App\Http\Controllers\Admin\Building\UpdateController::class)->name('admin.building.update');
        Route::delete('/{building}', \App\Http\Controllers\Admin\Building\DeleteController::class)->name('admin.building.delete');
    });
    Route::group(['prefix' => '/mosque-histories'], function() {
        Route::get('/', [\App\Http\Controllers\Admin\MosqueHistory\MosqueHistoryController::class, 'index'])->name('admin.mosque-history.index');
        Route::get('/create', [\App\Http\Controllers\Admin\MosqueHistory\MosqueHistoryController::class, 'create'])->name('admin.mosque-history.create');
        Route::get('/{mosqueHistory}', [\App\Http\Controllers\Admin\MosqueHistory\MosqueHistoryController::class, 'edit'])->name('admin.mosque-history.edit');

        Route::post('/', \App\Http\Controllers\Admin\MosqueHistory\StoreController::class)->name('admin.mosque-history.store');
        Route::put('/{mosqueHistory}', \App\Http\Controllers\Admin\MosqueHistory\UpdateController::class)->name('admin.mosque-history.update');
        Route::delete('/{mosqueHistory}', \App\Http\Controllers\Admin\MosqueHistory\DeleteController::class)->name('admin.mosque-history.delete');
    });
    Route::group(['prefix' => '/reviews'], function() {
        Route::get('/', [\App\Http\Controllers\Admin\Review\ReviewController::class, 'index'])->name('admin.review.index');
        Route::get('/create', [\App\Http\Controllers\Admin\Review\ReviewController::class, 'create'])->name('admin.review.create');
        Route::get('/{review}', [\App\Http\Controllers\Admin\Review\ReviewController::class, 'edit'])->name('admin.review.edit');

        Route::post('/', \App\Http\Controllers\Admin\Review\StoreController::class)->name('admin.review.store');
        Route::put('/{review}', \App\Http\Controllers\Admin\Review\UpdateController::class)->name('admin.review.update');
        Route::delete('/{review}', \App\Http\Controllers\Admin\Review\DeleteController::class)->name('admin.review.delete');
    });
    Route::group(['prefix' => '/achievements'], function() {
        Route::get('/', [\App\Http\Controllers\Admin\Achievement\AchievementController::class, 'index'])->name('admin.achievement.index');
        Route::get('/create', [\App\Http\Controllers\Admin\Achievement\AchievementController::class, 'create'])->name('admin.achievement.create');
        Route::get('/{achievement}', [\App\Http\Controllers\Admin\Achievement\AchievementController::class, 'edit'])->name('admin.achievement.edit');

        Route::post('/', \App\Http\Controllers\Admin\Achievement\StoreController::class)->name('admin.achievement.store');
        Route::put('/{achievement}', \App\Http\Controllers\Admin\Achievement\UpdateController::class)->name('admin.achievement.update');
        Route::delete('/{achievement}', \App\Http\Controllers\Admin\Achievement\DeleteController::class)->name('admin.achievement.delete');
    });
    Route::group(['prefix' => '/applications'], function() {
        Route::get('/', [\App\Http\Controllers\Admin\Application\ApplicationController::class, 'index'])->name('admin.application.index');
        Route::delete('/{application}', \App\Http\Controllers\Admin\Application\DeleteController::class)->name('admin.application.delete');
    });
    Route::group(['prefix' => '/text-images'], function() {
        Route::get('/', \App\Http\Controllers\Admin\TextImage\IndexController::class)->name('admin.textImage.index');

        Route::post('/', \App\Http\Controllers\Admin\TextImage\StoreController::class)->name('admin.textImage.store');
        Route::put('/{textImage}', \App\Http\Controllers\Admin\TextImage\UpdateController::class)->name('admin.textImage.update');
        Route::delete('/{textImage}', \App\Http\Controllers\Admin\TextImage\DeleteController::class)->name('admin.textImage.delete');
    });
    Route::group(['prefix' => '/history'], function() {
        Route::get('/', [\App\Http\Controllers\Admin\History\HistoryController::class, 'index'])->name('admin.history.index');

        Route::put('/', \App\Http\Controllers\Admin\History\UpdateController::class)->name('admin.history.update');
    });
});