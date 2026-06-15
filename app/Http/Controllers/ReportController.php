<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Medicine;
use App\Models\Purchase;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        return view('reports.index');
    }

    public function sales(Request $request)
    {
        $from = $request->from ?? now()->startOfMonth()->toDateString();
        $to   = $request->to ?? now()->toDateString();

        $sales = Sale::with('user', 'items.medicine')
            ->whereBetween('created_at', [$from, $to . ' 23:59:59'])
            ->orderBy('created_at', 'desc')
            ->get();

        $total_revenue = $sales->sum('total_amount');
        $total_sales   = $sales->count();

        return view('reports.sales', compact('sales', 'total_revenue', 'total_sales', 'from', 'to'));
    }

    public function inventory()
    {
        $medicines    = Medicine::orderBy('name')->get();
        $low_stock    = $medicines->filter(fn($m) => $m->isLowStock());
        $expired      = $medicines->filter(fn($m) => $m->isExpired());
        $expiring_soon = $medicines->filter(fn($m) => $m->isExpiringSoon());

        return view('reports.inventory', compact('medicines', 'low_stock', 'expired', 'expiring_soon'));
    }

    public function expiry()
    {
        $medicines = Medicine::orderBy('expiry_date')
            ->get()
            ->filter(fn($m) => !$m->isExpired() || $m->isExpiringSoon());

        $expired       = Medicine::orderBy('expiry_date')->get()->filter(fn($m) => $m->isExpired());
        $expiring_soon = Medicine::orderBy('expiry_date')->get()->filter(fn($m) => $m->isExpiringSoon());

        return view('reports.expiry', compact('medicines', 'expired', 'expiring_soon'));
    }
}