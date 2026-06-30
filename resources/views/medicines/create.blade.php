<x-app-layout>
    <x-slot name="header">Add New Medicine</x-slot>

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
                <form action="{{ route('medicines.store') }}" method="POST">
                    @csrf
                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-bottom:16px;">
                        <div>
                            <label style="display:block;font-size:11.5px;font-weight:500;color:#64748b;margin-bottom:5px;text-transform:uppercase;letter-spacing:.04em;">Medicine Name *</label>
                            <input type="text" name="name" value="{{ old('name') }}"
                                style="width:100%;padding:8px 12px;border:1px solid #dde3ec;border-radius:7px;font-size:13px;color:#1a2740;outline:none;font-family:inherit;">
                        </div>
                        <div>
                            <label style="display:block;font-size:11.5px;font-weight:500;color:#64748b;margin-bottom:5px;text-transform:uppercase;letter-spacing:.04em;">Generic Name</label>
                            <input type="text" name="generic_name" value="{{ old('generic_name') }}"
                                style="width:100%;padding:8px 12px;border:1px solid #dde3ec;border-radius:7px;font-size:13px;color:#1a2740;outline:none;font-family:inherit;">
                        </div>
                        <div>
                            <label style="display:block;font-size:11.5px;font-weight:500;color:#64748b;margin-bottom:5px;text-transform:uppercase;letter-spacing:.04em;">Category *</label>
                            <input type="text" name="category" value="{{ old('category') }}"
                                style="width:100%;padding:8px 12px;border:1px solid #dde3ec;border-radius:7px;font-size:13px;color:#1a2740;outline:none;font-family:inherit;">
                        </div>
                        <div>
                            <label style="display:block;font-size:11.5px;font-weight:500;color:#64748b;margin-bottom:5px;text-transform:uppercase;letter-spacing:.04em;">Supplier</label>
                            <input type="text" name="supplier" value="{{ old('supplier') }}"
                                style="width:100%;padding:8px 12px;border:1px solid #dde3ec;border-radius:7px;font-size:13px;color:#1a2740;outline:none;font-family:inherit;">
                        </div>
                        <div>
                            <label style="display:block;font-size:11.5px;font-weight:500;color:#64748b;margin-bottom:5px;text-transform:uppercase;letter-spacing:.04em;">Quantity *</label>
                            <input type="number" name="quantity" value="{{ old('quantity') }}"
                                style="width:100%;padding:8px 12px;border:1px solid #dde3ec;border-radius:7px;font-size:13px;color:#1a2740;outline:none;font-family:inherit;">
                        </div>
                        <div>
                            <label style="display:block;font-size:11.5px;font-weight:500;color:#64748b;margin-bottom:5px;text-transform:uppercase;letter-spacing:.04em;">Reorder Level *</label>
                            <input type="number" name="reorder_level" value="{{ old('reorder_level', 10) }}"
                                style="width:100%;padding:8px 12px;border:1px solid #dde3ec;border-radius:7px;font-size:13px;color:#1a2740;outline:none;font-family:inherit;">
                        </div>
                        <div>
                            <label style="display:block;font-size:11.5px;font-weight:500;color:#64748b;margin-bottom:5px;text-transform:uppercase;letter-spacing:.04em;">Buying Price (KES) *</label>
                            <input type="number" step="0.01" name="buying_price" value="{{ old('buying_price') }}"
                                style="width:100%;padding:8px 12px;border:1px solid #dde3ec;border-radius:7px;font-size:13px;color:#1a2740;outline:none;font-family:inherit;">
                        </div>
                        <div>
                            <label style="display:block;font-size:11.5px;font-weight:500;color:#64748b;margin-bottom:5px;text-transform:uppercase;letter-spacing:.04em;">Selling Price (KES) *</label>
                            <input type="number" step="0.01" name="selling_price" value="{{ old('selling_price') }}"
                                style="width:100%;padding:8px 12px;border:1px solid #dde3ec;border-radius:7px;font-size:13px;color:#1a2740;outline:none;font-family:inherit;">
                        </div>
                        <div>
                            <label style="display:block;font-size:11.5px;font-weight:500;color:#64748b;margin-bottom:5px;text-transform:uppercase;letter-spacing:.04em;">Expiry Date *</label>
                            <input type="date" name="expiry_date" value="{{ old('expiry_date') }}"
                                style="width:100%;padding:8px 12px;border:1px solid #dde3ec;border-radius:7px;font-size:13px;color:#1a2740;outline:none;font-family:inherit;">
                        </div>
                        <div>
                            <label style="display:block;font-size:11.5px;font-weight:500;color:#64748b;margin-bottom:5px;text-transform:uppercase;letter-spacing:.04em;">Batch Number</label>
                            <input type="text" name="batch_number" value="{{ old('batch_number') }}"
                                style="width:100%;padding:8px 12px;border:1px solid #dde3ec;border-radius:7px;font-size:13px;color:#1a2740;outline:none;font-family:inherit;">
                        </div>
                    </div>
                    <div style="margin-bottom:20px;">
                        <label style="display:block;font-size:11.5px;font-weight:500;color:#64748b;margin-bottom:5px;text-transform:uppercase;letter-spacing:.04em;">Description</label>
                        <textarea name="description" rows="3"
                            style="width:100%;padding:8px 12px;border:1px solid #dde3ec;border-radius:7px;font-size:13px;color:#1a2740;outline:none;font-family:inherit;resize:vertical;">{{ old('description') }}</textarea>
                    </div>
                    <div style="display:flex;gap:10px;">
                        <button type="submit"
                            style="background:#1a3557;color:#fff;padding:8px 20px;border-radius:7px;border:none;font-size:13px;font-weight:500;cursor:pointer;">
                            Save Medicine
                        </button>
                        <a href="{{ route('medicines.index') }}"
                            style="background:#f1f5f9;color:#64748b;padding:8px 20px;border-radius:7px;text-decoration:none;font-size:13px;font-weight:500;">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>