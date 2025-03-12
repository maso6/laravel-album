<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\TokenController;
use App\Http\Controllers\ImageController;

Route::post('custom-login', [CustomAuthController::class, 'customLogin'])->name('login.custom'); 
Route::post('custom-registration', [CustomAuthController::class, 'customRegistration'])->name('register.custom'); 
Route::get('signout', [CustomAuthController::class, 'signOut'])->name('signout');

// User and roles
Route::resource('roles', RoleController::class);
Route::resource('users', UserController::class);

Route::get('/', [GalleryController::class, 'index'])->name('public.galleries.index');
Route::get('admin', [GalleryController::class, 'index_admin'])->name('admin.galleries.index_admin');
Route::get('admin/tokens', [TokenController::class, 'index_admin'])->name('admin.tokens.index_admin');

Route::get('{token}', [GalleryController::class, 'index_public'])->name('public.galleries.index_public');
Route::get('{token}/{gallery_id}', [GalleryController::class, 'gallery_public'])->name('public.galleries.gallery_public');



// Gallery
Route::get('admin/galleries/create', [GalleryController::class, 'create'])->name('admin.galleries.create');
Route::post('admin/galleries/store', [GalleryController::class, 'store'])->name('admin.galleries.store');
Route::get('admin/galleries/{id}', [GalleryController::class, 'edit'])->name('admin.galleries.edit');
Route::get('admin/galleries/{id}/delete', [GalleryController::class, 'delete'])->name('admin.galleries.delete');
Route::post('admin/galleries/{id}/update', [GalleryController::class, 'update'])->name('admin.galleries.update');

// Images
Route::get('admin/images/create/{gallery_id}', [ImageController::class, 'create'])->name('admin.images.create');
Route::post('admin/images/store', [ImageController::class, 'store'])->name('admin.images.store');
Route::get('admin/images/{id}', [ImageController::class, 'edit'])->name('admin.images.edit');
Route::get('admin/images/{id}/delete', [ImageController::class, 'delete'])->name('admin.images.delete');
Route::post('admin/images/{id}/update', [ImageController::class, 'update'])->name('admin.images.update');

// Tokens
Route::get('admin/tokens/create', [TokenController::class, 'create'])->name('admin.tokens.create');
Route::post('admin/tokens/store', [TokenController::class, 'store'])->name('admin.tokens.store');
Route::get('admin/tokens/{id}', [TokenController::class, 'edit'])->name('admin.tokens.edit');
Route::get('admin/tokens/{id}/delete', [TokenController::class, 'delete'])->name('admin.tokens.delete');
Route::post('admin/tokens/{id}/update', [TokenController::class, 'update'])->name('admin.tokens.update');
Route::post('admin/tokens/updategallery', [TokenController::class, 'updategallery'])->name('admin.tokens.updategallery');
