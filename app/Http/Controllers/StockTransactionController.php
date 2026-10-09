<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\StockTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class StockTransactionController extends Controller
{
    /**
     * Display a listing of stock transactions (Audit Trail / History).
     */
    public function index(Request $request)
    {
        $type = $request->input('type', 'all');
        $search = trim($request->input('search', ''));

        $query = StockTransaction::with(['product', 'user'])->latest();

        if (in_array($type, ['in', 'out'])) {
            $query->where('type', $type);
        }

        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                $q->whereHas('product', function ($pQuery) use ($search) {
                    $pQuery->where('name', 'like', "%{$search}%")
                        ->orWhere('sku', 'like', "%{$search}%");
                })->orWhereHas('user', function ($uQuery) use ($search) {
                    $uQuery->where('name', 'like', "%{$search}%");
                })->orWhere('description', 'like', "%{$search}%");
            });
        }

        $transactions = $query->paginate(15)->withQueryString();

        return view('transactions.index', compact('transactions', 'type', 'search'));
    }

    /**
     * Show form for Stock In transaction.
     */
    public function createStockIn()
    {
        $products = Product::with('category')->orderBy('name')->get();
        return view('transactions.stock-in', compact('products'));
    }

    /**
     * Store a newly created Stock In transaction.
     */
    public function storeStockIn(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'description' => 'nullable|string|max:500',
        ]);

        $product = Product::findOrFail($validated['product_id']);

        DB::transaction(function () use ($product, $validated) {
            StockTransaction::create([
                'product_id' => $product->id,
                'user_id' => auth()->id(),
                'type' => 'in',
                'quantity' => $validated['quantity'],
                'description' => $validated['description'] ?? null,
            ]);

            $product->increment('stock', $validated['quantity']);
        });

        return redirect()->route('transactions.index')
            ->with('success', "Stock In berhasil dicatat! Stok {$product->name} bertambah {$validated['quantity']} unit.");
    }

    /**
     * Show form for Stock Out transaction.
     */
    public function createStockOut()
    {
        $products = Product::with('category')->orderBy('name')->get();
        return view('transactions.stock-out', compact('products'));
    }

    /**
     * Store a newly created Stock Out transaction.
     */
    public function storeStockOut(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'description' => 'nullable|string|max:500',
        ]);

        $product = Product::findOrFail($validated['product_id']);

        if ($product->stock < $validated['quantity']) {
            throw ValidationException::withMessages([
                'quantity' => "Stok tidak mencukupi! Stok saat ini untuk {$product->name} hanya tersisa {$product->stock} unit.",
            ]);
        }

        DB::transaction(function () use ($product, $validated) {
            StockTransaction::create([
                'product_id' => $product->id,
                'user_id' => auth()->id(),
                'type' => 'out',
                'quantity' => $validated['quantity'],
                'description' => $validated['description'] ?? null,
            ]);

            $product->decrement('stock', $validated['quantity']);
        });

        return redirect()->route('transactions.index')
            ->with('success', "Stock Out berhasil dicatat! Stok {$product->name} berkurang {$validated['quantity']} unit.");
    }
}

