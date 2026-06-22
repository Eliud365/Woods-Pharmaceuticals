<x-app-layout>
    <x-slot name="header">Add New User</x-slot>

    <div style="max-width:600px;">
        @if($errors->any())
            <div style="background:#fee2e2;border:1px solid #fecaca;color:#b91c1c;padding:12px 16px;border-radius:8px;margin-bottom:16px;font-size:13px;">
                <ul style="margin:0;padding-left:16px;">
                    @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
                </ul>
            </div>
        @endif
        <div style="background:#fff;border:1px solid #dde3ec;border-radius:10px;overflow:hidden;">
            <div style="padding:14px 20px;border-bottom:1px solid #dde3ec;">
                <h3 style="font-size:14px;font-weight:600;margin:0;color:#1a2740;">User Details</h3>
            </div>
            <div style="padding:20px;">
                <form action="{{ route('users.store') }}" method="POST">
                    @csrf
                    <div style="display:flex;flex-direction:column;gap:16px;">
                        <div>
                            <label style="display:block;font-size:11.5px;font-weight:500;color:#64748b;margin-bottom:5px;text-transform:uppercase;letter-spacing:.04em;">Full Name *</label>
                            <input type="text" name="name" value="{{ old('name') }}"
                                style="width:100%;padding:8px 12px;border:1px solid #dde3ec;border-radius:7px;font-size:13px;color:#1a2740;outline:none;font-family:inherit;">
                        </div>
                        <div>
                            <label style="display:block;font-size:11.5px;font-weight:500;color:#64748b;margin-bottom:5px;text-transform:uppercase;letter-spacing:.04em;">Email Address *</label>
                            <input type="email" name="email" value="{{ old('email') }}"
                                style="width:100%;padding:8px 12px;border:1px solid #dde3ec;border-radius:7px;font-size:13px;color:#1a2740;outline:none;font-family:inherit;">
                        </div>
                        <div>
                            <label style="display:block;font-size:11.5px;font-weight:500;color:#64748b;margin-bottom:5px;text-transform:uppercase;letter-spacing:.04em;">Role *</label>
                            <select name="role"
                                style="width:100%;padding:8px 12px;border:1px solid #dde3ec;border-radius:7px;font-size:13px;color:#1a2740;outline:none;font-family:inherit;">
                                <option value="">-- Select Role --</option>
                                <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="pharmacist" {{ old('role') === 'pharmacist' ? 'selected' : '' }}>Pharmacist</option>
                                <option value="cashier" {{ old('role') === 'cashier' ? 'selected' : '' }}>Cashier</option>
                            </select>
                        </div>
                        <div>
                            <label style="display:block;font-size:11.5px;font-weight:500;color:#64748b;margin-bottom:5px;text-transform:uppercase;letter-spacing:.04em;">Password *</label>
                            <input type="password" name="password"
                                style="width:100%;padding:8px 12px;border:1px solid #dde3ec;border-radius:7px;font-size:13px;color:#1a2740;outline:none;font-family:inherit;">
                        </div>
                        <div>
                            <label style="display:block;font-size:11.5px;font-weight:500;color:#64748b;margin-bottom:5px;text-transform:uppercase;letter-spacing:.04em;">Confirm Password *</label>
                            <input type="password" name="password_confirmation"
                                style="width:100%;padding:8px 12px;border:1px solid #dde3ec;border-radius:7px;font-size:13px;color:#1a2740;outline:none;font-family:inherit;">
                        </div>
                    </div>
                    <div style="display:flex;gap:10px;margin-top:20px;">
                        <button type="submit"
                            style="background:#1a3557;color:#fff;padding:8px 20px;border-radius:7px;border:none;font-size:13px;font-weight:500;cursor:pointer;">Create User</button>
                        <a href="{{ route('users.index') }}"
                            style="background:#f1f5f9;color:#64748b;padding:8px 20px;border-radius:7px;text-decoration:none;font-size:13px;font-weight:500;">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>