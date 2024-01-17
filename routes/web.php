<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'web']
], function () {
    Route::middleware(['auth', 'verified', 'checkControl'])->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('admin.index');
        Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('admin.dashboard');

        Route::get('/profile', [ProfileController::class, 'index'])->name('admin.profile');
        Route::post('/profile', [ProfileController::class, 'update'])->name('admin.profile.update');

        Route::resource('users', "\App\Http\Controllers\UserController", ['as' => 'admin'])->except(['show'])->missing(function () {
            Redirect::route('admin.users.index');
        });

        Route::get('categories', [CategoryController::class, 'index'])->name('admin.categories.index');
        Route::get('customers', [CustomerController::class, 'index'])->name('admin.customers.index');
        Route::get('products', [ProductController::class, 'index'])->name('admin.products.index');
        Route::get('products/{variant_ids}', [ProductController::class, 'show'])->name('admin.products.show');
    });
});
