<?php

use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\categorycontroller;
use App\Http\Controllers\productcontroller;
use App\Http\Controllers\profilecontroller;
use App\Http\Controllers\warehousecontroller;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login');
});

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

Route::get('/dashboard', function () {
    return view('welcome');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Profile routes
    Route::get('/profile/edit', [profilecontroller::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [profilecontroller::class, 'update'])->name('profile.update');
    Route::delete('/profile', [profilecontroller::class, 'destroy'])->name('profile.destroy');

    // Profile view routes
    Route::get('/profile', [profilecontroller::class, 'show'])->name('profile.main');
});


Route::prefix('admin')->middleware(['auth', 'isAdmin'])->group(function () {
    // Users management routes
    Route::get('/users', [AdminUserController::class, 'index'])->name('admin.users.index');
    Route::get('/users/{id}/edit', [AdminUserController::class, 'edit'])->name('admin.users.edit');
    Route::put('/users/{id}', [AdminUserController::class, 'update'])->name('admin.users.update');
    Route::delete('/users/{id}', [AdminUserController::class, 'destroy'])->name('admin.users.destroy');

    // Warehouse management routes
    Route::resource('warehouses', WarehouseController::class);
});

// Main warehouse page
Route::get('/warehouse', [warehousecontroller::class, 'main'])->name('warehouse.main');

Route::get('warehouse/contentWh', [WarehouseController::class, 'cw'])->name('warehouse.contentWh');

// Add a new warehouse
Route::post('/warehouse/add', [warehousecontroller::class, 'add'])->name('warehouse.add');

// Show details of a specific warehouse
Route::get('/warehouse/{id}', [WarehouseController::class, 'show'])->name('warehouse.inside');

// show warehouses in profile
Route::get('/profile', [profilecontroller::class, 'show2'])->name('profile.main');

Route::get('/profile', [ProfileController::class, 'show2'])->name('profile.main');
Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
Route::delete('/profile/delete', [ProfileController::class, 'destroy'])->name('profile.delete');


// Update a specific warehouse
Route::put('/warehouse/{id}', [WarehouseController::class, 'update'])->name('warehouse.update');

// Delete a specific warehouse
Route::post('/warehouse/delete/{id}', [WarehouseController::class, 'delete'])->name('warehouse.delete');

// Add new category
Route::post('warehouse/addc', [categorycontroller::class, 'add'])->name('warehouse.addc');

// Show category data
Route::get('warehouse/showCategory', [categorycontroller::class, 'showcategoryForm'])->name('warehouse.showc');

//Show product data
Route::get('/warehouse/{id}/products', [productcontroller::class, 'showproductForm'])->name('warehouse.showi');

// Show products on invoice page
Route::get('invoice/invoice', [productcontroller::class, 'showInvoice'])->name('invoice.show');

// Show user profile page
Route::get('profile/profile', [profilecontroller::class, 'show'])->name('profile.show');  // Fix to `profile.show`

// Ensure that other routes include the warehouse ID
Route::post('/warehouse/product/add', [productcontroller::class, 'add'])->name('warehouse.addi');
Route::put('/warehouse/product/edit/{id}', [productcontroller::class, 'edit'])->name('warehouse.updatei');
Route::delete('/warehouse/product/delete/{id}', [productcontroller::class, 'delete'])->name('warehouse.deletei');

// Route::get('invoice/invoice', function () {return view('invoice.invoice');});

require __DIR__ . '/auth.php';
