<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Edit Supplier: {{ $supplier->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">

                    @if($errors->any())
                        <div class="mb-4 p-4 bg-red-100 text-red-800 rounded">
                            <ul class="list-disc pl-5">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('suppliers.update', $supplier) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Supplier Name *</label>
                                <input type="text" name="name" value="{{ old('name', $supplier->name) }}"
                                    class="mt-1 w-full rounded border-gray-300 dark:bg-gray-700 dark:text-white shadow-sm">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Contact Person</label>
                                <input type="text" name="contact_person" value="{{ old('contact_person', $supplier->contact_person) }}"
                                    class="mt-1 w-full rounded border-gray-300 dark:bg-gray-700 dark:text-white shadow-sm">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Phone</label>
                                <input type="text" name="phone" value="{{ old('phone', $supplier->phone) }}"
                                    class="mt-1 w-full rounded border-gray-300 dark:bg-gray-700 dark:text-white shadow-sm">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
                                <input type="email" name="email" value="{{ old('email', $supplier->email) }}"
                                    class="mt-1 w-full rounded border-gray-300 dark:bg-gray-700 dark:text-white shadow-sm">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Address</label>
                                <input type="text" name="address" value="{{ old('address', $supplier->address) }}"
                                    class="mt-1 w-full rounded border-gray-300 dark:bg-gray-700 dark:text-white shadow-sm">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">County</label>
                                <input type="text" name="county" value="{{ old('county', $supplier->county) }}"
                                    class="mt-1 w-full rounded border-gray-300 dark:bg-gray-700 dark:text-white shadow-sm">
                            </div>

                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Status</label>
                                <select name="is_active"
                                    class="mt-1 w-full rounded border-gray-300 dark:bg-gray-700 dark:text-white shadow-sm">
                                    <option value="1" {{ $supplier->is_active ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ !$supplier->is_active ? 'selected' : '' }}>Inactive</option>
                                </select>
                            </div>

                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Notes</label>
                                <textarea name="notes" rows="3"
                                    class="mt-1 w-full rounded border-gray-300 dark:bg-gray-700 dark:text-white shadow-sm">{{ old('notes', $supplier->notes) }}</textarea>
                            </div>

                        </div>

                        <div class="mt-6 flex gap-4">
                            <button type="submit"
                                class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded">
                                Update Supplier
                            </button>
                            <a href="{{ route('suppliers.index') }}"
                                class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-6 rounded">
                                Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>