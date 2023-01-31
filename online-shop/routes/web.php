<?php

use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DetailsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderDetailsController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\OrdersController;

use App\Http\Controllers\ColorsController;
use App\Http\Controllers\SizesController;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UsersController;
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


Route::get('/', [HomeController::class, 'index'])->name('home');


Route::get('/add-product', [HomeController::class, 'add_product']);
Route::get('/add_toFavorite', [HomeController::class, 'add_toFavorite']);

Route::get('/shop', [HomeController::class, 'shop'])->name('shop');

Route::get('/{id}/details', [DetailsController::class, 'index']);

Route::get('/contact',[ContactController::class,'index'])->name('contact');
Route::post('/contact',[ContactController::class,'sendMessage']);

Route::get('/cart', [OrdersController::class, 'cart'])->name('cart');
Route::get('/productServices', [OrdersController::class, 'productServices']);

Route::post('/details', [DetailsController::class, 'store'])->name("details");


Route::get('/checkout', [CheckoutController::class, 'checkout'])->name('checkout');


Route::post('/addOrder',[CheckoutController::class, 'store'] );


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

Route::middleware(['auth', 'can:is_admin'])->prefix('/admin')->group(function () {
    Route::resource('/products', ProductsController::class);
    Route::resource('/users', UsersController::class);
    Route::get('/users/{id}/show', [UsersController::class, 'show']);

    Route::resource('/orders', OrderDetailsController::class);
    Route::get('/orders/{id}/show', [OrderDetailsController::class, 'show']);

    Route::resource('/orders', OrderDetailsController::class);
    Route::resource('/colors', ColorsController::class);
    Route::resource('/sizes', SizesController::class);


   Route::delete('/products/{id}', [ProductsController::class, 'destroy']);


    Route::get('/categories', [categoriesController::class, 'index']);
    Route::get('/categories/create', [categoriesController::class, 'create']);
    Route::post('/categories', [categoriesController::class, 'store'])->name("admin.categories");
    Route::get('/categories/{id}/edit', [categoriesController::class, 'edit']);
    Route::put('/categories/{id}', [categoriesController::class, 'update']);
    Route::get('/categories/{id}/show', [categoriesController::class, 'show']);
    Route::delete('/categories/{id}', [categoriesController::class, 'destroy']);



    // Route::resource('categories', CategoriesController::class);
});