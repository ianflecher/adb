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

// Customer Routes
Route::resource('customers', CustomerController::class);

// Order Routes
Route::resource('orders', OrderController::class);

// OrderItem Routes
Route::resource('order-items', OrderItemController::class);

// Product Routes
Route::resource('products', ProductController::class);


// Discount Routes
Route::resource('discounts', DiscountController::class);

// Feedback Routes
Route::resource('feedbacks', FeedbackController::class);

// Category Routes
Route::resource('categories', CategoryController::class);

// BundleItem Routes
Route::resource('bundle-items', BundleItemController::class);

// Payment Routes
Route::resource('payments', PaymentController::class);
