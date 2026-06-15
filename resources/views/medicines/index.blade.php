<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Medicines Inventory
            </h2>
            <a href="{{ route('medicines.create') }}"
               class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                + Add Medicine
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <table class="w-full text-sm text-left text-gray-700 dark:text-gray-300">
                        <thead class="bg-gray-100 dark:bg-gray-700 text-xs uppercase">
                            <tr>
                                <th class="px-4 py-3">#</th>
                                <th class="px-4 py-3">Name</th>
                                <th class="px-4 py-3">Category</th>
                                <th class="px-4 py-3">Quantity</th>
                                <th class="px-4 py-3">Selling Price</th>
                                <th class="px-4 py-3">Expiry Date</th>
                                <th class="px-4 py-3">Status</th>
                                <th class="px-4 py-3">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($medicines as $medicine)
                                <tr class="border-b dark:border-gray-700">
                                    <td class="px-4 py-3">{{ $loop->iteration }}</td>
                                    <td class="px-4 py-3 font-medium">{{ $medicine->name }}</td>
                                    <td class="px-4 py-3">{{ $medicine->category }}</td>
                                    <td class="px-4 py-3">
                                        <span class="{{ $medicine->isLowStock() ? 'text-red-600 font-bold' : '' }}">
                                            {{ $medicine->quantity }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3">KES {{ number_format($medicine->selling_price, 2) }}</td>
                                    <td class="px-4 py-3">{{ $medicine->expiry_date->format('d M Y') }}</td>
                                    <td class="px-4 py-3">
                                        @if($medicine->isExpired())
                                            <span class="px-2 py-1 bg-red-100 text-red-700 rounded text-xs">Expired</span>
                                        @elseif($medicine->isExpiringSoon())
                                            <span class="px-2 py-1 bg-yellow-100 text-yellow-700 rounded text-xs">Expiring Soon</span>
                                        @elseif($medicine->isLowStock())
                                            <span class="px-2 py-1 bg-orange-100 text-orange-700 rounded text-xs">Low Stock</span>
                                        @else
                                            <span class="px-2 py-1 bg-green-100 text-green-700 rounded text-xs">OK</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 flex gap-2">
                                        <a href="{{ route('medicines.edit', $medicine) }}"
                                           class="text-blue-600 hover:underline">Edit</a>
                                        <form action="{{ route('medicines.destroy', $medicine) }}" method="POST"
                                              onsubmit="return confirm('Delete this medicine?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:underline">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="px-4 py-6 text-center text-gray-500">
                                        No medicines found. Add your first medicine.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="mt-4">
                        {{ $medicines->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>