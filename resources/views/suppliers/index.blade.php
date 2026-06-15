<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Suppliers
            </h2>
            <a href="{{ route('suppliers.create') }}"
               class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                + Add Supplier
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
                                <th class="px-4 py-3">Contact Person</th>
                                <th class="px-4 py-3">Phone</th>
                                <th class="px-4 py-3">Email</th>
                                <th class="px-4 py-3">County</th>
                                <th class="px-4 py-3">Status</th>
                                <th class="px-4 py-3">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($suppliers as $supplier)
                                <tr class="border-b dark:border-gray-700">
                                    <td class="px-4 py-3">{{ $loop->iteration }}</td>
                                    <td class="px-4 py-3 font-medium">{{ $supplier->name }}</td>
                                    <td class="px-4 py-3">{{ $supplier->contact_person ?? '-' }}</td>
                                    <td class="px-4 py-3">{{ $supplier->phone ?? '-' }}</td>
                                    <td class="px-4 py-3">{{ $supplier->email ?? '-' }}</td>
                                    <td class="px-4 py-3">{{ $supplier->county ?? '-' }}</td>
                                    <td class="px-4 py-3">
                                        @if($supplier->is_active)
                                            <span class="px-2 py-1 bg-green-100 text-green-700 rounded text-xs">Active</span>
                                        @else
                                            <span class="px-2 py-1 bg-red-100 text-red-700 rounded text-xs">Inactive</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 flex gap-2">
                                        <a href="{{ route('suppliers.edit', $supplier) }}"
                                           class="text-blue-600 hover:underline">Edit</a>
                                        <form action="{{ route('suppliers.destroy', $supplier) }}" method="POST"
                                              onsubmit="return confirm('Delete this supplier?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:underline">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="px-4 py-6 text-center text-gray-500">
                                        No suppliers found. Add your first supplier.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="mt-4">
                        {{ $suppliers->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>