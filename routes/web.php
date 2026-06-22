<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MedicineController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $user = auth()->user();
    if ($user->isAdmin()) return redirect()->route('admin.dashboard');
    if ($user->isPharmacist()) return redirect()->route('pharmacist.dashboard');
    return redirect()->route('cashier.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('dashboards.admin');
    })->name('admin.dashboard');
});

Route::middleware(['auth', 'role:pharmacist'])->group(function () {
    Route::get('/pharmacist/dashboard', function () {
        return view('dashboards.pharmacist');
    })->name('pharmacist.dashboard');
});

Route::middleware(['auth', 'role:cashier'])->group(function () {
    Route::get('/cashier/dashboard', function () {
        return view('dashboards.cashier');
    })->name('cashier.dashboard');
});

Route::middleware(['auth', 'role:admin,pharmacist'])->group(function () {
    Route::resource('medicines', MedicineController::class);
});

Route::middleware(['auth', 'role:admin,cashier'])->group(function () {
    Route::get('/sales', [SaleController::class, 'index'])->name('sales.index');
    Route::get('/sales/create', [SaleController::class, 'create'])->name('sales.create');
    Route::post('/sales', [SaleController::class, 'store'])->name('sales.store');
    Route::get('/sales/{id}/receipt', [SaleController::class, 'index_receipt'])->name('sales.receipt');
    Route::delete('/sales/{sale}', [SaleController::class, 'destroy'])->name('sales.destroy');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('suppliers', SupplierController::class);
});

Route::middleware(['auth', 'role:admin,pharmacist'])->group(function () {
    Route::resource('purchases', PurchaseController::class)->except(['edit', 'update']);
    Route::post('purchases/{purchase}/receive', [PurchaseController::class, 'receive'])->name('purchases.receive');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    Route::get('/reports/sales', [ReportController::class, 'sales'])->name('reports.sales');
    Route::get('/reports/inventory', [ReportController::class, 'inventory'])->name('reports.inventory');
    Route::get('/reports/expiry', [ReportController::class, 'expiry'])->name('reports.expiry');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'admin'])->name('admin.dashboard');
});

Route::middleware(['auth', 'role:pharmacist'])->group(function () {
    Route::get('/pharmacist/dashboard', [DashboardController::class, 'pharmacist'])->name('pharmacist.dashboard');
});

Route::middleware(['auth', 'role:cashier'])->group(function () {
    Route::get('/cashier/dashboard', [DashboardController::class, 'cashier'])->name('cashier.dashboard');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('users', UserController::class)->except(['show']);
});

require __DIR__.'/auth.php';