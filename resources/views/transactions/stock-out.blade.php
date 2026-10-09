<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Catat Barang Keluar (Stock Out)') }}
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
                     qty: {{ old('quantity', 1) }},
                     get selectedProduct() {
                         return this.products.find(p => p.id == this.selectedId);
                     },
                     get isOutOfStock() {
                         return this.selectedProduct && this.selectedProduct.stock <= 0;
                     },
                     get isOverStock() {
                         return this.selectedProduct && this.qty > this.selectedProduct.stock;
                     }
                 }">

                <div class="border-b border-gray-100 dark:border-gray-700 pb-4 mb-6">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white flex items-center gap-2">
                        <span class="p-2 rounded-lg bg-rose-100 text-rose-700 dark:bg-rose-900/50 dark:text-rose-300">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 13l-5 5m0 0l-5-5m5 5V6"/>
                            </svg>
                        </span>
                        Form Transaksi Barang Keluar
                    </h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                        Gunakan form ini untuk mencatat pengeluaran barang ke user/divisi, pemindahan, atau pemakaian operasional.
                    </p>
                </div>

                <form action="{{ route('transactions.stock-out.store') }}" method="POST" class="space-y-6">
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
                            class="w-full rounded-lg border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900 text-gray-900 dark:text-white shadow-sm focus:border-rose-500 focus:ring-rose-500"
                        >
                            <option value="">-- Pilih Barang --</option>
                            @foreach ($products as $product)
                                <option value="{{ $product->id }}" {{ old('product_id') == $product->id ? 'selected' : '' }}>
                                    {{ $product->name }} (SKU: {{ $product->sku }}) - Sisa Stok: {{ $product->stock }}
                                </option>
                            @endforeach
                        </select>
                        @error('product_id')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Info Box Produk Terpilih & Validasi Visual -->
                    <template x-if="selectedProduct">
                        <div>
                            <div class="p-4 rounded-lg flex items-center justify-between"
                                 :class="isOutOfStock ? 'bg-red-50 border border-red-200 dark:bg-red-950/40 dark:border-red-900' : 'bg-amber-50 border border-amber-200 dark:bg-amber-950/40 dark:border-amber-900'">
                                <div>
                                    <span class="text-xs uppercase font-bold tracking-wider" 
                                          :class="isOutOfStock ? 'text-red-800 dark:text-red-300' : 'text-amber-800 dark:text-amber-300'">
                                        Status Stok Barang
                                    </span>
                                    <h4 class="text-base font-semibold text-gray-900 dark:text-white" x-text="selectedProduct.name"></h4>
                                    <p class="text-xs text-gray-500 font-mono" x-text="'SKU: ' + selectedProduct.sku + ' | Lokasi: ' + selectedProduct.location"></p>
                                </div>
                                <div class="text-right">
                                    <span class="text-xs text-gray-500 block">Stok Tersedia</span>
                                    <span class="text-2xl font-bold" 
                                          :class="isOutOfStock ? 'text-red-600 dark:text-red-400' : 'text-amber-600 dark:text-amber-400'"
                                          x-text="selectedProduct.stock + ' Unit'"></span>
                                </div>
                            </div>

                            <!-- Peringatan jika Stok Kosong -->
                            <div x-show="isOutOfStock" class="mt-2 text-sm text-red-600 dark:text-red-400 font-medium flex items-center gap-1.5">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                                </svg>
                                Perhatian: Stok barang ini habis (0 unit), transaksi Stock Out tidak dapat dilanjutkan.
                            </div>

                            <!-- Peringatan jika Input Melebihi Stok -->
                            <div x-show="isOverStock && !isOutOfStock" class="mt-2 text-sm text-rose-600 dark:text-rose-400 font-medium flex items-center gap-1.5">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                                </svg>
                                Jumlah keluar melebihi stok yang ada (Maksimal: <span x-text="selectedProduct.stock"></span> unit).
                            </div>
                        </div>
                    </template>

                    <!-- Jumlah Barang Keluar -->
                    <div>
                        <label for="quantity" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Jumlah Barang Keluar (Quantity) <span class="text-red-500">*</span>
                        </label>
                        <input
                            type="number"
                            name="quantity"
                            id="quantity"
                            min="1"
                            x-model.number="qty"
                            required
                            placeholder="Contoh: 2"
                            class="w-full rounded-lg border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900 text-gray-900 dark:text-white shadow-sm focus:border-rose-500 focus:ring-rose-500"
                        >
                        @error('quantity')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Keterangan / Catatan -->
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Keterangan / Alasan Pengeluaran <span class="text-gray-400 text-xs">(Opsional)</span>
                        </label>
                        <textarea
                            name="description"
                            id="description"
                            rows="3"
                            placeholder="Contoh: Diberikan untuk laptop karyawan baru Divisi Engineering / Penggantian unit rusak..."
                            class="w-full rounded-lg border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900 text-gray-900 dark:text-white shadow-sm focus:border-rose-500 focus:ring-rose-500"
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
                                :disabled="isOutOfStock || isOverStock"
                                :class="(isOutOfStock || isOverStock) ? 'opacity-50 cursor-not-allowed bg-rose-400' : 'bg-rose-600 hover:bg-rose-700'"
                                class="inline-flex items-center px-6 py-2 text-white text-sm font-semibold rounded-lg shadow-sm transition">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 13l-5 5m0 0l-5-5m5 5V6"/>
                            </svg>
                            Simpan Stock Out
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>

