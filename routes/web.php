<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\FrontEndCartController;
use App\Http\Controllers\FrontEndOrderController;
use App\Http\Controllers\FrontEndProductController;
use App\Http\Controllers\FrontEndServicesController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ProductSubCategoryController;
use App\Http\Controllers\ServicesCategoryController;
use App\Http\Controllers\ServicesController;
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

Route::get('/', [HomeController::class, 'index']);


Route::get('/products', [FrontEndProductController::class, 'index']);
Route::get('/cart', [FrontEndCartController::class, 'index']);
Route::get('/checkout', function () {
    return view('front-end.checkout.view');
});

Route::get('/success', function () {
    return view('front-end.success.view');
});
Route::get('/products/{url}/{sub_url}/{product}', [FrontEndProductController::class, 'fetchSingle']);
Route::get('/products/fetch/{id}', [FrontEndProductController::class, 'fetchAll']);
Route::get('/products/{url}', [FrontEndProductController::class, 'category']);
Route::get('/products/{url}/{sub_url}', [FrontEndProductController::class, 'SubCategory']);

Route::get('/services', [FrontEndServicesController::class, 'index']);
Route::get('/services/{url}', [FrontEndServicesController::class, 'category']);
Route::get('/services/{url}/{services}', [FrontEndServicesController::class, 'fetchSingle']);

Route::post('/place-order', [FrontEndOrderController::class, 'saveOrder'])->name('products.saveOrder');

Route::prefix('admin')->group(function () {
    Route::controller(AuthenticationController::class)->group(function () {
        Route::get('/register', 'register')->name('register');
        Route::post('/store', 'store')->name('store');
        Route::get('/login', 'login')->name('login');
        Route::post('/authenticate', 'authenticate')->name('authenticate');
        Route::get('/dashboard', function () {
            return view('admin.layout');
        });
        Route::post('/logout', 'logout')->name('logout');
    });

    Route::get('/', [AdminController::class, 'index']);

    Route::group(['middleware' => 'auth'], function () {
        Route::resource('products', ProductsController::class);
        Route::resource('categories', ProductCategoryController::class);
        Route::resource('service-categories', ServicesCategoryController::class);
        Route::resource('sub-categories', ProductSubCategoryController::class);
        Route::resource('services', ServicesController::class);
        Route::resource('orders', OrderController::class);
        Route::post('menus/update-order', [MenuController::class, 'updateOrder'])->name('menus.updateOrder');
        Route::get('menus/update-orders', [MenuController::class, 'updateOrderGet'])->name('menus.updateOrderGet');
        Route::resource('menus', MenuController::class);
    });
});
