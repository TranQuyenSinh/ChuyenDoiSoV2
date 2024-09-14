<?php

use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\LinhVucController;
use App\Http\Controllers\Admin\TinTucController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\TrangChu\HomeController;
use App\Models\NganhNghe;
use Illuminate\Support\Facades\Route;

// Upload file and image
Route::post('file/uploads', [FileController::class, 'uploads'])->middleware('auth');
Route::get('file/delete/{filename}', [FileController::class, 'delete'])->middleware('auth');
Route::post('image/uploads', [ImageController::class, 'uploads'])->middleware('auth');
Route::get('image/delete/{filename}', [ImageController::class, 'delete'])->middleware('auth');

// Trang chủ
Route::get('/', [HomeController::class, 'index'])->name('trangchu');
// Admin
Route::prefix('admin')->as('admin.')->group(function () {
    // Tin tức
    Route::prefix('tin-tuc')->as('tintuc.')->group(function () {
        Route::get('/', [TinTucController::class, 'index'])->name('index');
        Route::get('add', [TinTucController::class, 'add'])->name('add');
        Route::post('create', [TinTucController::class, 'create'])->name('create');
        Route::get('{tintuc}/edit', [TinTucController::class, 'edit'])->name('edit');
        Route::post('{tintuc}/update', [TinTucController::class, 'update'])->name('update');
        Route::get('{tintuc}/delete', [TinTucController::class, 'delete'])->name('delete');
    });
    // Banner
    Route::prefix('banner')->as('banner.')->group(function () {
        Route::get('/', [BannerController::class, 'index'])->name('index');
        Route::get('add', [BannerController::class, 'add'])->name('add');
        Route::post('create', [BannerController::class, 'create'])->name('create');
        Route::get('{banner}/edit', [BannerController::class, 'edit'])->name('edit');
        Route::post('{banner}/update', [BannerController::class, 'update'])->name('update');
        Route::get('{banner}/delete', [BannerController::class, 'delete'])->name('delete');
    });
    // Lĩnh vực
    Route::prefix('linh-vuc')->as('linhvuc.')->group(function () {
        Route::get('/', [LinhVucController::class, 'index'])->name('index');
        Route::get('add', [LinhVucController::class, 'add'])->name('add');
        Route::post('create', [LinhVucController::class, 'create'])->name('create');
        Route::get('{linhvuc}/edit', [LinhVucController::class, 'edit'])->name('edit');
        Route::post('{linhvuc}/update', [LinhVucController::class, 'update'])->name('update');
        Route::get('{linhvuc}/delete', [LinhVucController::class, 'delete'])->name('delete');
    });
    // Ngành nghề
    Route::prefix('nganh-nghe')->as('nganhnghe.')->group(function () {
        Route::get('/', [NganhNghe::class, 'index'])->name('index');
        Route::get('add', [NganhNghe::class, 'add'])->name('add');
        Route::post('create', [NganhNghe::class, 'create'])->name('create');
        Route::get('{nganhnghe}/edit', [NganhNghe::class, 'edit'])->name('edit');
        Route::post('{nganhnghe}/update', [NganhNghe::class, 'update'])->name('update');
        Route::get('{nganhnghe}/delete', [NganhNghe::class, 'delete'])->name('delete');
    });
});
