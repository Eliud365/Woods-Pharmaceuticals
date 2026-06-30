<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\SaleItem;
use App\Models\Medicine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{
    public function index()
    {
        $sales = Sale::with('user')->orderBy('created_at', 'desc')->paginate(10);
        return view('sales.index', compact('sales'));
    }

    public function create()
    {
        $medicines = Medicine::where('quantity', '>', 0)->orderBy('name')->get();
        return view('sales.create', compact('medicines'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'medicines'             => 'required|array|min:1',
            'medicines.*.id'        => 'required|exists:medicines,id',
            'medicines.*.quantity'  => 'required|integer|min:1',
            'amount_paid'           => 'required|numeric|min:0',
            'payment_method'        => 'required|in:cash,mpesa,insurance',
            'customer_name'         => 'nullable|string|max:255',
        ]);

        // Check stock before processing
        foreach ($request->medicines as $item) {
            $medicine = Medicine::findOrFail($item['id']);
            if ($medicine->quantity < $item['quantity']) {
                return back()
                    ->withInput()
                    ->withErrors(['medicines' => "Insufficient stock for {$medicine->name}. Available: {$medicine->quantity}, Requested: {$item['quantity']}"]);
            }
        }

        DB::transaction(function () use ($request) {
            $total = 0;
            $items = [];

            foreach ($request->medicines as $item) {
                $medicine = Medicine::findOrFail($item['id']);
                $subtotal = $medicine->selling_price * $item['quantity'];
                $total += $subtotal;

                $items[] = [
                    'medicine_id' => $medicine->id,
                    'quantity'    => $item['quantity'],
                    'unit_price'  => $medicine->selling_price,
                    'subtotal'    => $subtotal,
                ];

                $medicine->decrement('quantity', $item['quantity']);
            }

            $sale = Sale::create([
                'user_id'        => auth()->id(),
                'receipt_number' => Sale::generateReceiptNumber(),
                'total_amount'   => $total,
                'amount_paid'    => $request->amount_paid,
                'change_given'   => $request->amount_paid - $total,
                'payment_method' => $request->payment_method,
                'customer_name'  => $request->customer_name,
                'notes'          => $request->notes,
            ]);

            foreach ($items as $item) {
                $sale->items()->create($item);
            }

            session(['last_sale_id' => $sale->id]);
        });

        return redirect()->route('sales.receipt', session('last_sale_id'))
            ->with('success', 'Sale completed successfully.');
    }

    public function index_receipt($id)
    {
        $sale = Sale::with('items.medicine', 'user')->findOrFail($id);
        return view('sales.receipt', compact('sale'));
    }

    public function destroy(Sale $sale)
    {
        $sale->delete();
        return redirect()->route('sales.index')
            ->with('success', 'Sale deleted successfully.');
    }
}