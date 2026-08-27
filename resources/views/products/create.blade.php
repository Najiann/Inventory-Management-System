<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Create New Product
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">

                <form action="{{ route('products.store') }}"
                      method="POST"
                      enctype="multipart/form-data"
                      class="space-y-5">

                    @csrf

                    {{-- Product Name --}}
                    <div>
                        <label for="name"
                               class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Product Name
                        </label>

                        <input
                            type="text"
                            name="name"
                            id="name"
                            value="{{ old('name') }}"
                            required
                            class="mt-1 block w-full rounded-lg border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                        >

                        @error('name')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>


                    {{-- Category --}}
                    <div>
                        <label for="category_id"
                               class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Category
                        </label>

                        <select
                            name="category_id"
                            id="category_id"
                            required
                            class="mt-1 block w-full rounded-lg border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                        >

                            <option value="">-- Select Category --</option>

                            @foreach ($categories as $category)
                                <option
                                    value="{{ $category->id }}"
                                    {{ old('category_id') == $category->id ? 'selected' : '' }}
                                >
                                    {{ $category->name }}
                                </option>
                            @endforeach

                        </select>

                        @error('category_id')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>


                    {{-- SKU --}}
                    <div>
                        <label for="sku"
                               class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            SKU
                        </label>

                        <input
                            type="text"
                            name="sku"
                            id="sku"
                            value="{{ old('sku') }}"
                            required
                            class="mt-1 block w-full rounded-lg border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                        >

                        @error('sku')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>


                    {{-- Price --}}
                    <div>
                        <label for="price"
                               class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Price
                        </label>

                        <input
                            type="number"
                            name="price"
                            id="price"
                            value="{{ old('price') }}"
                            min="0"
                            step="0.01"
                            required
                            class="mt-1 block w-full rounded-lg border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                        >

                        @error('price')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>


                    {{-- Stock --}}
                    <div>
                        <label for="stock"
                               class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Stock
                        </label>

                        <input
                            type="number"
                            name="stock"
                            id="stock"
                            value="{{ old('stock', 0) }}"
                            min="0"
                            required
                            class="mt-1 block w-full rounded-lg border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                        >

                        @error('stock')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>


                    {{-- Condition --}}
                    <div>
                        <label for="condition"
                               class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Condition
                        </label>

                        <select
                            name="condition"
                            id="condition"
                            required
                            class="mt-1 block w-full rounded-lg border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                        >
                            <option value="">-- Select Condition --</option>
                            <option value="good" {{ old('condition') == 'good' ? 'selected' : '' }}>
                                Good
                            </option>
                            <option value="damaged" {{ old('condition') == 'damaged' ? 'selected' : '' }}>
                                Damaged
                            </option>
                        </select>

                        @error('condition')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>


                    {{-- Location --}}
                    <div>
                        <label for="location"
                               class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Location
                        </label>

                        <input
                            type="text"
                            name="location"
                            id="location"
                            value="{{ old('location') }}"
                            required
                            placeholder="Contoh: Warehouse A"
                            class="mt-1 block w-full rounded-lg border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                        >

                        @error('location')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>


                    {{-- Description --}}
                    <div>
                        <label for="description"
                               class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Description
                        </label>

                        <textarea
                            name="description"
                            id="description"
                            rows="4"
                            class="mt-1 block w-full rounded-lg border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                        >{{ old('description') }}</textarea>

                        @error('description')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>


                    {{-- Image --}}
                    <div>
                        <label for="image"
                               class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Product Image
                        </label>

                        <input
                            type="file"
                            name="image"
                            id="image"
                            accept="image/jpeg,image/png,image/jpg"
                            class="mt-1 block w-full text-sm text-gray-700 dark:text-gray-300"
                        >

                        @error('image')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>


                    {{-- Buttons --}}
                    <div class="flex items-center gap-3 pt-4">

                        <button
                            type="submit"
                            class="px-5 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-lg"
                        >
                            Save Product
                        </button>

                        <a
                            href="{{ route('products.index') }}"
                            class="px-5 py-2 bg-gray-500 hover:bg-gray-600 text-white font-medium rounded-lg"
                        >
                            Cancel
                        </a>

                    </div>

                </form>

            </div>
        </div>
    </div>

</x-app-layout>