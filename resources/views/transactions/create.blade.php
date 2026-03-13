@extends('layouts.inventory')

@section('title', 'Record Transaction')
@section('header', 'New Movement')

@section('content')
<div class="glass-card" style="max-width: 600px;">
    @if($errors->any())
        <div style="margin-bottom: 1.5rem; padding: 1rem; background: rgba(239, 68, 68, 0.1); border-radius: 0.5rem; color: var(--danger);">
            <ul style="margin-left: 1.5rem;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('transactions.store') }}" method="POST">
        @csrf

        <div style="margin-bottom: 1.5rem;">
            <label style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Item</label>
            <select name="item_id" required style="width: 100%; padding: 0.75rem; border-radius: 0.5rem; border: 1px solid var(--border); background: white;">
                @foreach($items as $item)
                    <option value="{{ $item->id }}" {{ old('item_id') == $item->id ? 'selected' : '' }}>
                        {{ $item->name }} (Stock: {{ $item->stock }})
                    </option>
                @endforeach
            </select>
        </div>

        <div style="margin-bottom: 1.5rem;">
            <label style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Movement Type</label>
            <div style="display: flex; gap: 2rem;">
                <label style="display: flex; align-items: center; cursor: pointer;">
                    <input type="radio" name="type" value="in" checked style="margin-right: 8px;"> IN (Stock Increase)
                </label>
                <label style="display: flex; align-items: center; cursor: pointer;">
                    <input type="radio" name="type" value="out" style="margin-right: 8px;"> OUT (Stock Decrease)
                </label>
            </div>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1.5rem;">
            <div>
                <label style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Quantity</label>
                <input type="number" name="quantity" value="{{ old('quantity', 1) }}" required min="1"
                    style="width: 100%; padding: 0.75rem; border-radius: 0.5rem; border: 1px solid var(--border);">
            </div>
            <div>
                <label style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Date</label>
                <input type="datetime-local" name="date" value="{{ old('date', date('Y-m-d\TH:i')) }}" required 
                    style="width: 100%; padding: 0.75rem; border-radius: 0.5rem; border: 1px solid var(--border);">
            </div>
        </div>

        <div style="margin-bottom: 2rem;">
            <label style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Reference (Supplier/Client)</label>
            <input type="text" name="reference_name" value="{{ old('reference_name') }}" placeholder="Optional"
                style="width: 100%; padding: 0.75rem; border-radius: 0.5rem; border: 1px solid var(--border);">
        </div>

        <div style="display: flex; gap: 1rem;">
            <button type="submit" class="btn btn-primary" style="flex: 1; justify-content: center;">
                Submit Transaction
            </button>
            <a href="{{ route('transactions.index') }}" class="btn" style="background: var(--border); color: var(--text-main); flex: 1; justify-content: center;">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection
