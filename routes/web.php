<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Auth::routes();
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('index');
Route::get('/tentang', [App\Http\Controllers\HomeController::class, 'about'])->name('about');
Route::get('/blog', [App\Http\Controllers\HomeController::class, 'article'])->name('article');
Route::get('/blog/{slug}', [App\Http\Controllers\HomeController::class, 'article_detail'])->name('article-detail');
Route::get('/edukasi', [App\Http\Controllers\HomeController::class, 'video'])->name('video');
Route::get('/edukasi/{slug}', [App\Http\Controllers\HomeController::class, 'video_play'])->name('video-play');
Route::get('/product', [App\Http\Controllers\HomeController::class, 'product'])->name('product');
Route::get('/product/{slug}', [App\Http\Controllers\HomeController::class, 'product_detail'])->name('product-detail');

Route::post('/', [App\Http\Controllers\HomeController::class, 'add_cart'])->name('add-cart')->middleware(['checkRole:pembeli,penjual,admin']);
Route::get('/cart', [App\Http\Controllers\HomeController::class, 'cart'])->name('cart')->middleware(['checkRole:pembeli,penjual,admin']);
Route::get('/cart/{id}', [App\Http\Controllers\HomeController::class, 'delete_cart'])->name('cart-delete')->middleware(['checkRole:pembeli,penjual,admin']);
Route::get('/order', [App\Http\Controllers\HomeController::class, 'order'])->name('order')->middleware(['checkRole:pembeli,penjual,admin']);
Route::post('/order', [App\Http\Controllers\HomeController::class, 'add_order'])->name('add-order')->middleware(['checkRole:pembeli,penjual,admin']);

Route::prefix('admin')->group(function () {
    Route::get('/', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin')->middleware(['checkRole:penjual,admin']);
    
    Route::get('category', [App\Http\Controllers\Admin\CategoryController::class, 'index'])->name('admin.category')->middleware(['checkRole:penjual,admin']);
    Route::get('category/create', [App\Http\Controllers\Admin\CategoryController::class, 'create'])->name('admin.category.create')->middleware(['checkRole:penjual,admin']);
    Route::post('category/create', [App\Http\Controllers\Admin\CategoryController::class, 'store'])->name('admin.category.store')->middleware(['checkRole:penjual,admin']);
    Route::get('category/edit/{id}', [App\Http\Controllers\Admin\CategoryController::class, 'edit'])->name('admin.category.edit')->middleware(['checkRole:penjual,admin']);
    Route::patch('category/edit/{id}/update', [App\Http\Controllers\Admin\CategoryController::class, 'update'])->name('admin.category.update')->middleware(['checkRole:penjual,admin']);
    Route::get('category/delete/{id}', [App\Http\Controllers\Admin\CategoryController::class, 'destroy'])->name('admin.category.delete')->middleware(['checkRole:penjual,admin']);
    
    Route::get('product', [App\Http\Controllers\Admin\ProductController::class, 'index'])->name('admin.product')->middleware(['checkRole:penjual,admin']);
    Route::get('product/create', [App\Http\Controllers\Admin\ProductController::class, 'create'])->name('admin.product.create')->middleware(['checkRole:penjual,admin']);
    Route::post('product/create', [App\Http\Controllers\Admin\ProductController::class, 'store'])->name('admin.product.store')->middleware(['checkRole:penjual,admin']);
    Route::get('product/edit/{id}', [App\Http\Controllers\Admin\ProductController::class, 'edit'])->name('admin.product.edit')->middleware(['checkRole:penjual,admin']);
    Route::patch('product/edit/{id}/update', [App\Http\Controllers\Admin\ProductController::class, 'update'])->name('admin.product.update')->middleware(['checkRole:penjual,admin']);
    Route::get('product/delete/{id}', [App\Http\Controllers\Admin\ProductController::class, 'destroy'])->name('admin.product.delete')->middleware(['checkRole:penjual,admin']);

    Route::get('article', [App\Http\Controllers\Admin\ArticleController::class, 'index'])->name('admin.article')->middleware(['checkRole:penjual,admin']);
    Route::get('article/create', [App\Http\Controllers\Admin\ArticleController::class, 'create'])->name('admin.article.create')->middleware(['checkRole:penjual,admin']);
    Route::post('article/create', [App\Http\Controllers\Admin\ArticleController::class, 'store'])->name('admin.article.store')->middleware(['checkRole:penjual,admin']);
    Route::get('article/edit/{id}', [App\Http\Controllers\Admin\ArticleController::class, 'edit'])->name('admin.article.edit')->middleware(['checkRole:penjual,admin']);
    Route::patch('article/edit/{id}/update', [App\Http\Controllers\Admin\ArticleController::class, 'update'])->name('admin.article.update')->middleware(['checkRole:penjual,admin']);
    Route::get('article/delete/{id}', [App\Http\Controllers\Admin\ArticleController::class, 'destroy'])->name('admin.article.delete')->middleware(['checkRole:penjual,admin']);

    Route::get('video', [App\Http\Controllers\Admin\VideoController::class, 'index'])->name('admin.video')->middleware(['checkRole:penjual,admin']);
    Route::get('video/create', [App\Http\Controllers\Admin\VideoController::class, 'create'])->name('admin.video.create')->middleware(['checkRole:penjual,admin']);
    Route::post('video/create', [App\Http\Controllers\Admin\VideoController::class, 'store'])->name('admin.video.store')->middleware(['checkRole:penjual,admin']);
    Route::get('video/edit/{id}', [App\Http\Controllers\Admin\VideoController::class, 'edit'])->name('admin.video.edit')->middleware(['checkRole:penjual,admin']);
    Route::patch('video/edit/{id}/update', [App\Http\Controllers\Admin\VideoController::class, 'update'])->name('admin.video.update')->middleware(['checkRole:penjual,admin']);
    Route::get('video/delete/{id}', [App\Http\Controllers\Admin\VideoController::class, 'destroy'])->name('admin.video.delete')->middleware(['checkRole:penjual,admin']);

    Route::get('user', [App\Http\Controllers\Admin\UserController::class, 'index'])->name('admin.user')->middleware(['checkRole:admin']);
    Route::get('user/create', [App\Http\Controllers\Admin\UserController::class, 'create'])->name('admin.user.create')->middleware(['checkRole:admin']);
    Route::post('user/create', [App\Http\Controllers\Admin\UserController::class, 'store'])->name('admin.user.store')->middleware(['checkRole:admin']);
    Route::get('user/delete/{id}', [App\Http\Controllers\Admin\UserController::class, 'destroy'])->name('admin.user.delete')->middleware(['checkRole:admin']);    
    
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
