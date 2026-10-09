<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Catat Barang Masuk (Stock In)') }}
            </h2>
            <a href="{{ route('transactions.index') }}" 
               class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white flex items-center gap-1">
                &larr; Kembali ke Riwayat
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg border border-gray-100 dark:border-gray-700 p-6 md:p-8"
                 x-data="{
                     products: {{ $products->toJson() }},
                     selectedId: '{{ old('product_id', '') }}',
                     get selectedProduct() {
                         return this.products.find(p => p.id == this.selectedId);
                     }
                 }">

                <div class="border-b border-gray-100 dark:border-gray-700 pb-4 mb-6">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white flex items-center gap-2">
                        <span class="p-2 rounded-lg bg-emerald-100 text-emerald-700 dark:bg-emerald-900/50 dark:text-emerald-300">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11l5-5m0 0l5 5m-5-5v12"/>
                            </svg>
                        </span>
                        Form Transaksi Barang Masuk
                    </h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                        Gunakan form ini untuk mencatat penerimaan barang baru, pengadaan, atau pengembalian ke gudang.
                    </p>
                </div>

                <form action="{{ route('transactions.stock-in.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <!-- Pilih Produk -->
                    <div>
                        <label for="product_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Pilih Barang <span class="text-red-500">*</span>
                        </label>
                        <select
                            name="product_id"
                            id="product_id"
                            x-model="selectedId"
                            required
                            class="w-full rounded-lg border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900 text-gray-900 dark:text-white shadow-sm focus:border-emerald-500 focus:ring-emerald-500"
                        >
                            <option value="">-- Pilih Barang --</option>
                            @foreach ($products as $product)
                                <option value="{{ $product->id }}" {{ old('product_id') == $product->id ? 'selected' : '' }}>
                                    {{ $product->name }} (SKU: {{ $product->sku }}) - Stok Saat Ini: {{ $product->stock }}
                                </option>
                            @endforeach
                        </select>
                        @error('product_id')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Info Box Produk Terpilih -->
                    <template x-if="selectedProduct">
                        <div class="p-4 rounded-lg bg-emerald-50 dark:bg-emerald-950/30 border border-emerald-200 dark:border-emerald-900 flex items-center justify-between">
                            <div>
                                <span class="text-xs uppercase font-bold tracking-wider text-emerald-800 dark:text-emerald-300">Status Stok Saat Ini</span>
                                <h4 class="text-base font-semibold text-gray-900 dark:text-white" x-text="selectedProduct.name"></h4>
                                <p class="text-xs text-gray-500 font-mono" x-text="'SKU: ' + selectedProduct.sku + ' | Lokasi: ' + selectedProduct.location"></p>
                            </div>
                            <div class="text-right">
                                <span class="text-xs text-gray-500 block">Tersedia</span>
                                <span class="text-2xl font-bold text-emerald-600 dark:text-emerald-400" x-text="selectedProduct.stock + ' Unit'"></span>
                            </div>
                        </div>
                    </template>

                    <!-- Jumlah Barang Masuk -->
                    <div>
                        <label for="quantity" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Jumlah Barang Masuk (Quantity) <span class="text-red-500">*</span>
                        </label>
                        <input
                            type="number"
                            name="quantity"
                            id="quantity"
                            min="1"
                            value="{{ old('quantity', 1) }}"
                            required
                            placeholder="Contoh: 10"
                            class="w-full rounded-lg border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900 text-gray-900 dark:text-white shadow-sm focus:border-emerald-500 focus:ring-emerald-500"
                        >
                        @error('quantity')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Keterangan / Catatan -->
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Keterangan / Catatan Transaksi <span class="text-gray-400 text-xs">(Opsional)</span>
                        </label>
                        <textarea
                            name="description"
                            id="description"
                            rows="3"
                            placeholder="Contoh: Pengadaan batch Q4 dari Vendor Lenovo, PO-2026-081..."
                            class="w-full rounded-lg border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900 text-gray-900 dark:text-white shadow-sm focus:border-emerald-500 focus:ring-emerald-500"
                        >{{ old('description') }}</textarea>
                        @error('description')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-100 dark:border-gray-700">
                        <a href="{{ route('transactions.index') }}" 
                           class="px-4 py-2 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 text-sm font-medium rounded-lg hover:bg-gray-200 transition">
                            Batal
                        </a>
                        <button type="submit" 
                                class="inline-flex items-center px-6 py-2 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold rounded-lg shadow-sm transition">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            Simpan Stock In
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>

