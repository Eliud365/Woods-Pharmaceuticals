<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Models\PurchaseItem;
use App\Models\Medicine;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PurchaseController extends Controller
{
    public function index()
    {
        $purchases = Purchase::with('supplier', 'user')->orderBy('created_at', 'desc')->paginate(10);
        return view('purchases.index', compact('purchases'));
    }

    public function create()
    {
        $suppliers = Supplier::where('is_active', true)->orderBy('name')->get();
        $medicines = Medicine::orderBy('name')->get();
        return view('purchases.create', compact('suppliers', 'medicines'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'supplier_id'           => 'required|exists:suppliers,id',
            'order_date'            => 'required|date',
            'expected_date'         => 'nullable|date|after_or_equal:order_date',
            'medicines'             => 'required|array|min:1',
            'medicines.*.id'        => 'required|exists:medicines,id',
            'medicines.*.quantity'  => 'required|integer|min:1',
            'medicines.*.unit_price'=> 'required|numeric|min:0',
            'notes'                 => 'nullable|string',
        ]);

        DB::transaction(function () use ($request) {
            $total = 0;
            $items = [];

            foreach ($request->medicines as $item) {
                $subtotal = $item['unit_price'] * $item['quantity'];
                $total += $subtotal;

                $items[] = [
                    'medicine_id' => $item['id'],
                    'quantity'    => $item['quantity'],
                    'unit_price'  => $item['unit_price'],
                    'subtotal'    => $subtotal,
                ];
            }

            $purchase = Purchase::create([
                'supplier_id'      => $request->supplier_id,
                'user_id'          => auth()->id(),
                'reference_number' => Purchase::generateReferenceNumber(),
                'total_amount'     => $total,
                'status'           => 'pending',
                'order_date'       => $request->order_date,
                'expected_date'    => $request->expected_date,
                'notes'            => $request->notes,
            ]);

            foreach ($items as $item) {
                $purchase->items()->create($item);
            }
        });

        return redirect()->route('purchases.index')
            ->with('success', 'Purchase order created successfully.');
    }

    public function show(Purchase $purchase)
    {
        $purchase->load('supplier', 'user', 'items.medicine');
        return view('purchases.show', compact('purchase'));
    }

    public function receive(Purchase $purchase)
    {
        if ($purchase->status === 'received') {
            return redirect()->route('purchases.index')
                ->with('error', 'Purchase already received.');
        }

        DB::transaction(function () use ($purchase) {
            foreach ($purchase->items as $item) {
                $item->medicine->increment('quantity', $item->quantity);
            }

            $purchase->update([
                'status'        => 'received',
                'received_date' => now(),
            ]);
        });

        return redirect()->route('purchases.index')
            ->with('success', 'Purchase received and stock updated.');
    }

    public function destroy(Purchase $purchase)
    {
        $purchase->delete();
        return redirect()->route('purchases.index')
            ->with('success', 'Purchase order deleted.');
    }
}