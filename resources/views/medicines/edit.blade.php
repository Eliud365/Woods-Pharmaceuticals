<x-app-layout>
    <x-slot name="header">Edit Medicine: {{ $medicine->name }}</x-slot>

    <div style="max-width:800px;">

        @if($errors->any())
            <div style="background:#fee2e2;border:1px solid #fecaca;color:#b91c1c;padding:12px 16px;border-radius:8px;margin-bottom:16px;font-size:13px;">
                <ul style="margin:0;padding-left:16px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div style="background:#fff;border:1px solid #dde3ec;border-radius:10px;overflow:hidden;">
            <div style="padding:14px 20px;border-bottom:1px solid #dde3ec;">
                <h3 style="font-size:14px;font-weight:600;margin:0;color:#1a2740;">Medicine Details</h3>
            </div>
            <div style="padding:20px;">
                <form action="{{ route('medicines.update', $medicine) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-bottom:16px;">
                        <div>
                            <label style="display:block;font-size:11.5px;font-weight:500;color:#64748b;margin-bottom:5px;text-transform:uppercase;letter-spacing:.04em;">Medicine Name *</label>
                            <input type="text" name="name" value="{{ old('name', $medicine->name) }}"
                                style="width:100%;padding:8px 12px;border:1px solid #dde3ec;border-radius:7px;font-size:13px;color:#1a2740;outline:none;font-family:inherit;">
                        </div>
                        <div>
                            <label style="display:block;font-size:11.5px;font-weight:500;color:#64748b;margin-bottom:5px;text-transform:uppercase;letter-spacing:.04em;">Generic Name</label>
                            <input type="text" name="generic_name" value="{{ old('generic_name', $medicine->generic_name) }}"
                                style="width:100%;padding:8px 12px;border:1px solid #dde3ec;border-radius:7px;font-size:13px;color:#1a2740;outline:none;font-family:inherit;">
                        </div>
                        <div>
                            <label style="display:block;font-size:11.5px;font-weight:500;color:#64748b;margin-bottom:5px;text-transform:uppercase;letter-spacing:.04em;">Category *</label>
                            <input type="text" name="category" value="{{ old('category', $medicine->category) }}"
                                style="width:100%;padding:8px 12px;border:1px solid #dde3ec;border-radius:7px;font-size:13px;color:#1a2740;outline:none;font-family:inherit;">
                        </div>
                        <div>
                            <label style="display:block;font-size:11.5px;font-weight:500;color:#64748b;margin-bottom:5px;text-transform:uppercase;letter-spacing:.04em;">Supplier</label>
                            <input type="text" name="supplier" value="{{ old('supplier', $medicine->supplier) }}"
                                style="width:100%;padding:8px 12px;border:1px solid #dde3ec;border-radius:7px;font-size:13px;color:#1a2740;outline:none;font-family:inherit;">
                        </div>
                        <div>
                            <label style="display:block;font-size:11.5px;font-weight:500;color:#64748b;margin-bottom:5px;text-transform:uppercase;letter-spacing:.04em;">Quantity *</label>
                            <input type="number" name="quantity" value="{{ old('quantity', $medicine->quantity) }}"
                                style="width:100%;padding:8px 12px;border:1px solid #dde3ec;border-radius:7px;font-size:13px;color:#1a2740;outline:none;font-family:inherit;">
                        </div>
                        <div>
                            <label style="display:block;font-size:11.5px;font-weight:500;color:#64748b;margin-bottom:5px;text-transform:uppercase;letter-spacing:.04em;">Reorder Level *</label>
                            <input type="number" name="reorder_level" value="{{ old('reorder_level', $medicine->reorder_level) }}"
                                style="width:100%;padding:8px 12px;border:1px solid #dde3ec;border-radius:7px;font-size:13px;color:#1a2740;outline:none;font-family:inherit;">
                        </div>
                        <div>
                            <label style="display:block;font-size:11.5px;font-weight:500;color:#64748b;margin-bottom:5px;text-transform:uppercase;letter-spacing:.04em;">Buying Price (KES) *</label>
                            <input type="number" step="0.01" name="buying_price" value="{{ old('buying_price', $medicine->buying_price) }}"
                                style="width:100%;padding:8px 12px;border:1px solid #dde3ec;border-radius:7px;font-size:13px;color:#1a2740;outline:none;font-family:inherit;">
                        </div>
                        <div>
                            <label style="display:block;font-size:11.5px;font-weight:500;color:#64748b;margin-bottom:5px;text-transform:uppercase;letter-spacing:.04em;">Selling Price (KES) *</label>
                            <input type="number" step="0.01" name="selling_price" value="{{ old('selling_price', $medicine->selling_price) }}"
                                style="width:100%;padding:8px 12px;border:1px solid #dde3ec;border-radius:7px;font-size:13px;color:#1a2740;outline:none;font-family:inherit;">
                        </div>
                        <div>
                            <label style="display:block;font-size:11.5px;font-weight:500;color:#64748b;margin-bottom:5px;text-transform:uppercase;letter-spacing:.04em;">Expiry Date *</label>
                            <input type="date" name="expiry_date" value="{{ old('expiry_date', $medicine->expiry_date->format('Y-m-d')) }}"
                                style="width:100%;padding:8px 12px;border:1px solid #dde3ec;border-radius:7px;font-size:13px