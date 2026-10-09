<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StockTransactionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::middleware('auth')->group(function () {
    // Role-based redirect
    Route::get('/dashboard', function () {
        $user = auth()->user();

        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        if ($user->role === 'staff') {
            return redirect()->route('staff.dashboard');
        }

        return redirect()->route('home');
    })->name('dashboard');

    // Profile Management
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Products (Read-only for all authenticated users: Admin & Staff)
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');

    // Transactions History & Operations (Accessible by both Staff & Admin)
    Route::get('/transactions', [StockTransactionController::class, 'index'])->name('transactions.index');
    Route::get('/transactions/stock-in', [StockTransactionController::class, 'createStockIn'])->name('transactions.stock-in');
    Route::post('/transactions/stock-in', [StockTransactionController::class, 'storeStockIn'])->name('transactions.stock-in.store');
    Route::get('/transactions/stock-out', [StockTransactionController::class, 'createStockOut'])->name('transactions.stock-out');
    Route::post('/transactions/stock-out', [StockTransactionController::class, 'storeStockOut'])->name('transactions.stock-out.store');
});

// Admin-Only Routes
Route::middleware(['auth', 'admin'])->group(function () {
    // Admin Dashboard
    Route::get('/admin', [DashboardController::class, 'admin'])->name('admin.dashboard');

    // Category CRUD
    Route::resource('categories', CategoryController::class);

    // Product Write Operations (Create, Store, Edit, Update, Delete)
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::match(['put', 'patch'], '/products/{product}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
});

// Staff-Only Routes
Route::middleware(['auth', 'staff'])->group(function () {
    // Staff Dashboard
    Route::get('/staff', [DashboardController::class, 'staff'])->name('staff.dashboard');
});

require __DIR__.'/auth.php';
