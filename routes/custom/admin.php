<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth','admin']], function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    /**
     * Profile Management
     * Change Password
     */
    Route::get('change-password', [DashboardController::class, 'changePassword'])->name('changePassword');
    Route::post('update-password', [DashboardController::class, 'updatePassword'])->name('updatePassword');

    /**
     * Category Management
     */
    Route::resource('category',CategoryController::class);
    Route::resource('sub-category',SubCategoryController::class);

    /**
     * Product Management
     */
    Route::resource('product',ProductController::class);
    Route::resource('available-product-size',ProductSizeController::class);

    /**
     * Image Management
     */
    Route::resource('image',ImageController::class);

    /**
     * Invoice Management
     */

    Route::resource('invoice',InvoiceManagentController::class);
});
