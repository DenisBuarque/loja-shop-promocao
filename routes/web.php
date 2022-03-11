<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;

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

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/product', function () {
    return view('product');
});


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/', [SiteController::class, 'site'])->name('site');
Route::get('/politics', [SiteController::class, 'politics'])->name('politics');
Route::get('/product/{slug}', [SiteController::class, 'detail'])->name('detail');
Route::get('/category/{slug}', [SiteController::class, 'category'])->name('category');
Route::post('/product/search', [SiteController::class, 'search'])->name('search');

Route::get('/users', [UserController::class, 'index'])->name('user.index');
Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
Route::post('/user/store', [UserController::class, 'store'])->name('user.store');
Route::get('/user/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
Route::put('/user/update/{id}', [UserController::class, 'update'])->name('user.update');
Route::delete('/user/delete/{id}', [UserController::class, 'destroy'])->name('user.destroy');

Route::get('/categories', [CategoryController::class, 'index'])->name('category.index');
Route::get('/category/create', [CategoryController::class, 'create'])->name('category.create');
Route::post('/category/store', [CategoryController::class, 'store'])->name('category.store');
Route::get('/category/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
Route::put('/category/update/{id}', [CategoryController::class, 'update'])->name('category.update');
Route::delete('/category/delete/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');

Route::get('/products', [ProductController::class, 'index'])->name('product.index');
Route::get('/product/create', [ProductController::class, 'create'])->name('product.create');
Route::post('/product/store', [ProductController::class, 'store'])->name('product.store');
Route::get('/product/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
Route::put('/product/update/{id}', [ProductController::class, 'update'])->name('product.update');
Route::delete('/product/delete/{id}', [ProductController::class, 'destroy'])->name('product.destroy');
Route::delete('/product/photo/remove', [ProductController::class, 'remove'])->name('photo.remove');