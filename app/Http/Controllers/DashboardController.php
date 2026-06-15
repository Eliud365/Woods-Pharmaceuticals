<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use App\Models\Sale;
use App\Models\Supplier;
use App\Models\Purchase;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function admin()
    {
        $total_medicines  = Medicine::count();
        $total_suppliers  = Supplier::count();
        $low_stock        = Medicine::whereColumn('quantity', '<=', 'reorder_level')->count();
        $expired          = Medicine::whereDate('expiry_date', '<', now())->count();
        $expiring_soon    = Medicine::whereDate('expiry_date', '>=', now())
                            ->whereDate('expiry_date', '<=', now()->addDays(30))
                            ->count();
        $today_sales      = Sale::whereDate('created_at', today())->sum('total_amount');
        $today_count      = Sale::whereDate('created_at', today())->count();
        $monthly_revenue  = Sale::whereMonth('created_at', now()->month)
                            ->whereYear('created_at', now()->year)
                            ->sum('total_amount');
        $pending_purchases = Purchase::where('status', 'pending')->count();
        $recent_sales     = Sale::with('user')->orderBy('created_at', 'desc')->take(5)->get();
        $low_stock_medicines = Medicine::whereColumn('quantity', '<=', 'reorder_level')->take(5)->get();

        return view('dashboards.admin', compact(
            'total_medicines', 'total_suppliers', 'low_stock', 'expired',
            'expiring_soon', 'today_sales', 'today_count', 'monthly_revenue',
            'pending_purchases', 'recent_sales', 'low_stock_medicines'
        ));
    }

    public function pharmacist()
    {
        $total_medicines     = Medicine::count();
        $low_stock           = Medicine::whereColumn('quantity', '<=', 'reorder_level')->count();
        $expired             = Medicine::whereDate('expiry_date', '<', now())->count();
        $expiring_soon       = Medicine::whereDate('expiry_date', '>=', now())
                               ->whereDate('expiry_date', '<=', now()->addDays(30))
                               ->count();
        $low_stock_medicines = Medicine::whereColumn('quantity', '<=', 'reorder_level')->take(5)->get();

        return view('dashboards.pharmacist', compact(
            'total_medicines', 'low_stock', 'expired', 'expiring_soon', 'low_stock_medicines'
        ));
    }

    public function cashier()
    {
        $today_sales  = Sale::whereDate('created_at', today())->where('user_id', auth()->id())->sum('total_amount');
        $today_count  = Sale::whereDate('created_at', today())->where('user_id', auth()->id())->count();
        $recent_sales = Sale::with('items')->where('user_id', auth()->id())->orderBy('created_at', 'desc')->take(5)->get();

        return view('dashboards.cashier', compact('today_sales', 'today_count', 'recent_sales'));
    }
}