<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use Illuminate\Http\Request;

class MedicineController extends Controller
{
    public function index()
    {
        $medicines = Medicine::orderBy('name')->paginate(10);
        return view('medicines.index', compact('medicines'));
    }

    public function create()
    {
        return view('medicines.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'          => 'required|string|max:255',
            'generic_name'  => 'nullable|string|max:255',
            'category'      => 'required|string|max:255',
            'supplier'      => 'nullable|string|max:255',
            'quantity'      => 'required|integer|min:0',
            'reorder_level' => 'required|integer|min:0',
            'buying_price'  => 'required|numeric|min:0',
            'selling_price' => 'required|numeric|min:0',
            'expiry_date'   => 'required|date|after:today',
            'batch_number'  => 'nullable|string|max:255',
            'description'   => 'nullable|string',
        ]);

        Medicine::create($request->all());

        return redirect()->route('medicines.index')
            ->with('success', 'Medicine added successfully.');
    }

    public function show(Medicine $medicine)
    {
        return view('medicines.show', compact('medicine'));
    }

    public function edit(Medicine $medicine)
    {
        return view('medicines.edit', compact('medicine'));
    }

    public function update(Request $request, Medicine $medicine)
    {
        $request->validate([
            'name'          => 'required|string|max:255',
            'generic_name'  => 'nullable|string|max:255',
            'category'      => 'required|string|max:255',
            'supplier'      => 'nullable|string|max:255',
            'quantity'      => 'required|integer|min:0',
            'reorder_level' => 'required|integer|min:0',
            'buying_price'  => 'required|numeric|min:0',
            'selling_price' => 'required|numeric|min:0',
            'expiry_date'   => 'required|date',
            'batch_number'  => 'nullable|string|max:255',
            'description'   => 'nullable|string',
        ]);

        $medicine->update($request->all());

        return redirect()->route('medicines.index')
            ->with('success', 'Medicine updated successfully.');
    }

    public function destroy(Medicine $medicine)
    {
        $medicine->delete();

        return redirect()->route('medicines.index')
            ->with('success', 'Medicine deleted successfully.');
    }
}