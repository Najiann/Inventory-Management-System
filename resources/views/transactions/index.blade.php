<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{ __('Riwayat Transaksi Stok') }}
                </h2>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                    Audit trail seluruh aktivitas barang masuk (Stock In) dan barang keluar (Stock Out).
                </p>
            </div>
            <div class="flex items-center gap-2">
                <a href="{{ route('transactions.stock-in') }}" 
                   class="inline-flex items-center px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-medium rounded-lg shadow-sm transition duration-150">
                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    + Stock In (Masuk)
                </a>
                <a href="{{ route('transactions.stock-out') }}" 
                   class="inline-flex items-center px-4 py-2 bg-rose-600 hover:bg-rose-700 text-white text-sm font-medium rounded-lg shadow-sm transition duration-150">
                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"/>
                    </svg>
                    - Stock Out (Keluar)
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Flash Success Message -->
            @if (session('success'))
                <div class="p-4 rounded-lg bg-emerald-50 dark:bg-emerald-900/30 border border-emerald-200 dark:border-emerald-800 text-emerald-800 dark:text-emerald-200 flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        <span>{{ session('success') }}</span>
                    </div>
                </div>
            @endif

            <!-- Filter & Search Toolbar -->
            <div class="bg-white dark:bg-gray-800 p-4 rounded-lg border border-gray-100 dark:border-gray-700 shadow-sm flex flex-col md:flex-row gap-4 justify-between items-center">
                <!-- Type Filter Pills -->
                <div class="flex items-center gap-1 bg-gray-100 dark:bg-gray-700/60 p-1 rounded-lg w-full md:w-auto">
                    <a href="{{ route('transactions.index', ['type' => 'all', 'search' => $search]) }}" 
                       class="px-4 py-1.5 rounded-md text-sm font-medium transition {{ $type === 'all' ? 'bg-white dark:bg-gray-800 text-gray-900 dark:text-white shadow-sm' : 'text-gray-600 dark:text-gray-300 hover:text-gray-900' }}">
                        Semua
                    </a>
                    <a href="{{ route('transactions.index', ['type' => 'in', 'search' => $search]) }}" 
                       class="px-4 py-1.5 rounded-md text-sm font-medium transition {{ $type === 'in' ? 'bg-emerald-600 text-white shadow-sm' : 'text-gray-600 dark:text-gray-300 hover:text-gray-900' }}">
                        Barang Masuk (IN)
                    </a>
                    <a href="{{ route('transactions.index', ['type' => 'out', 'search' => $search]) }}" 
                       class="px-4 py-1.5 rounded-md text-sm font-medium transition {{ $type === 'out' ? 'bg-rose-600 text-white shadow-sm' : 'text-gray-600 dark:text-gray-300 hover:text-gray-900' }}">
                        Barang Keluar (OUT)
                    </a>
                </div>

                <!-- Search Form -->
                <form action="{{ route('transactions.index') }}" method="GET" class="flex gap-2 w-full md:w-auto">
                    <input type="hidden" name="type" value="{{ $type }}">
                    <input
                        type="search"
                        name="search"
                        value="{{ $search }}"
                        placeholder="Cari barang, SKU, staf, keterangan..."
                        class="rounded-lg border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900 text-gray-900 dark:text-white placeholder-gray-400 text-sm focus:ring-indigo-500 focus:border-indigo-500 w-full md:w-72"
                    >
                    <button type="submit" class="px-4 py-2 bg-gray-800 dark:bg-gray-700 text-white text-sm font-medium rounded-lg hover:bg-gray-900 dark:hover:bg-gray-600 transition">
                        Cari
                    </button>
                    @if ($search !== '')
                        <a href="{{ route('transactions.index', ['type' => $type]) }}" class="px-3 py-2 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 text-sm font-medium rounded-lg hover:bg-gray-300 transition">
                            Reset
                        </a>
                    @endif
                </form>
            </div>

            <!-- Transactions Table Card -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg border border-gray-100 dark:border-gray-700">
                <div class="overflow-x-auto p-6 text-gray-900 dark:text-gray-100">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead>
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                    Waktu Transaksi
                                </th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                    Tipe
                                </th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                    Barang
                                </th>
                                <th class="px-4 py-3 text-center text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                    Jumlah (Qty)
                                </th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                    Operator / Staf
                                </th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                    Keterangan
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            @forelse ($transactions as $tx)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-750 transition duration-150">
                                    <!-- Tanggal -->
                                    <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-600 dark:text-gray-300">
                                        <div class="font-medium text-gray-900 dark:text-white">{{ $tx->created_at->format('d M Y') }}</div>
                                        <div class="text-xs text-gray-400">{{ $tx->created_at->format('H:i:s') }}</div>
                                    </td>

                                    <!-- Tipe Transaksi Badge -->
                                    <td class="px-4 py-4 whitespace-nowrap text-sm">
                                        @if ($tx->type === 'in')
                                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-800 dark:bg-emerald-900/40 dark:text-emerald-300">
                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11l5-5m0 0l5 5m-5-5v12"/>
                                                </svg>
                                                STOCK IN
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-rose-100 text-rose-800 dark:bg-rose-900/40 dark:text-rose-300">
                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 13l-5 5m0 0l-5-5m5 5V6"/>
                                                </svg>
                                                STOCK OUT
                                            </span>
                                        @endif
                                    </td>

                                    <!-- Barang -->
                                    <td class="px-4 py-4 whitespace-nowrap text-sm">
                                        <div class="flex items-center gap-3">
                                            @if ($tx->product && $tx->product->image)
                                                <img src="{{ asset('storage/' . $tx->product->image) }}" alt="{{ $tx->product->name }}" class="w-10 h-10 object-cover rounded-lg">
                                            @else
                                                <div class="w-10 h-10 bg-gray-100 dark:bg-gray-700 rounded-lg flex items-center justify-center text-gray-400">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                                    </svg>
                                                </div>
                                            @endif
                                            <div>
                                                <div class="font-semibold text-gray-900 dark:text-white">
                                                    {{ $tx->product ? $tx->product->name : 'Barang Dihapus' }}
                                                </div>
                                                <div class="text-xs text-gray-500 font-mono">
                                                    SKU: {{ $tx->product ? $tx->product->sku : '-' }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>

                                    <!-- Jumlah -->
                                    <td class="px-4 py-4 whitespace-nowrap text-center text-sm font-bold">
                                        @if ($tx->type === 'in')
                                            <span class="text-emerald-600 dark:text-emerald-400">+{{ $tx->quantity }}</span>
                                        @else
                                            <span class="text-rose-600 dark:text-rose-400">-{{ $tx->quantity }}</span>
                                        @endif
                                    </td>

                                    <!-- User / Operator -->
                                    <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-700 dark:text-gray-300">
                                        <div class="font-medium text-gray-900 dark:text-white">
                                            {{ $tx->user ? $tx->user->name : 'Sistem' }}
                                        </div>
                                        <div class="text-xs text-gray-400 capitalize">
                                            Role: {{ $tx->user ? $tx->user->role : '-' }}
                                        </div>
                                    </td>

                                    <!-- Keterangan -->
                                    <td class="px-4 py-4 text-sm text-gray-600 dark:text-gray-300 max-w-xs truncate">
                                        {{ $tx->description ?: '-' }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-12 text-center text-gray-500 dark:text-gray-400">
                                        <svg class="w-12 h-12 mx-auto text-gray-300 dark:text-gray-600 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                                        </svg>
                                        Belum ada riwayat transaksi stok yang sesuai filter.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    @if ($transactions->hasPages())
                        <div class="mt-4 pt-4 border-t border-gray-100 dark:border-gray-700">
                            {{ $transactions->links() }}
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
</x-app-layout>

