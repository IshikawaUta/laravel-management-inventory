<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with(['item', 'user'])->latest()->get();
        return view('transactions.index', compact('transactions'));
    }

    public function create()
    {
        $items = Item::all();
        return view('transactions.create', compact('items'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'item_id' => 'required|exists:items,id',
            'type' => 'required|in:in,out',
            'quantity' => 'required|integer|min:1',
            'reference_name' => 'nullable|string|max:255',
            'date' => 'required|date',
        ]);

        $item = Item::findOrFail($validated['item_id']);

        if ($validated['type'] === 'out' && $item->stock < $validated['quantity']) {
            return back()->withErrors(['quantity' => 'Insufficient stock.'])->withInput();
        }

        DB::transaction(function () use ($validated, $item) {
            // Create transaction
            Transaction::create([
                'user_id' => auth()->id(),
                'item_id' => $validated['item_id'],
                'type' => $validated['type'],
                'quantity' => $validated['quantity'],
                'reference_name' => $validated['reference_name'],
                'date' => $validated['date'],
            ]);

            // Update item stock
            if ($validated['type'] === 'in') {
                $item->increment('stock', $validated['quantity']);
            } else {
                $item->decrement('stock', $validated['quantity']);
            }
        });

        return redirect()->route('transactions.index')->with('success', 'Transaction recorded successfully.');
    }
}
