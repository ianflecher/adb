<?php

use Illuminate\Support\Facades\Route;
// routes/web.php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderItemController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BundleItemController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    return view('user.home');   
});

Route::get('/admin', function () {
    return view('admin.login');
});

Route::get('/user', function () {
    return view('user/landingpage');
});


Route::get('product/add', [ProductController::class, 'create'])->name('product.add');

Route::post('/add-to-cart/{productId}', [ProductController::class, 'addToCart'])->name('add.to.cart');

Route::get('/products/category/{id}', [ProductController::class, 'filterByCategory'])->name('product.category');

// Handle the admin login submission at /admin/login
Route::post('admin/login', [AdminController::class, 'login'])->name('admin.login');

// Show the admin dashboard at /admin/dashboard
Route::get('admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

// Handle admin logout at /admin/logout
Route::post('admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

Route::get('admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
Route::get('user', [ProductController::class, 'index'])->name('user.landingpage');

Route::get('admin/dashboard', [ProductController::class, 'index'])->name('admin.dashboard');
Route::delete('/product/{product}', [ProductController::class, 'destroy'])->name('product.destroy');
Route::post('/save-cart', [ProductController::class, 'saveCart']);
Route::get('user/checkout', [OrderController::class, 'showCheckoutPage']);
Route::get('user/payment', [OrderController::class, 'payment'])->name('payment');
Route::post('/checkout', [OrderController::class, 'checkout']);
