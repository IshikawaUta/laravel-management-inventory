@extends('layouts.inventory')

@section('title', isset($item) ? 'Edit Item' : 'Add Item')
@section('header', isset($item) ? 'Edit Item: ' . $item->name : 'Add New Item')

@section('content')
<div class="glass-card" style="max-width: 600px;">
    <form action="{{ isset($item) ? route('items.update', $item) : route('items.store') }}" method="POST">
        @csrf
        @if(isset($item))
            @method('PUT')
        @endif

        <div style="margin-bottom: 1.5rem;">
            <label style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Category</label>
            <select name="category_id" required style="width: 100%; padding: 0.75rem; border-radius: 0.5rem; border: 1px solid var(--border); background: white;">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ (isset($item) && $item->category_id == $category->id) ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div style="margin-bottom: 1.5rem;">
            <label style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Item Name</label>
            <input type="text" name="name" value="{{ $item->name ?? old('name') }}" required 
                style="width: 100%; padding: 0.75rem; border-radius: 0.5rem; border: 1px solid var(--border);">
        </div>

        <div style="margin-bottom: 1.5rem;">
            <label style="display: block; margin-bottom: 0.5rem; font-weight: 500;">SKU Code</label>
            <input type="text" name="sku" value="{{ $item->sku ?? old('sku') }}" required 
                style="width: 100%; padding: 0.75rem; border-radius: 0.5rem; border: 1px solid var(--border);">
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 2rem;">
            <div>
                <label style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Price (Rp)</label>
                <input type="number" name="price" value="{{ $item->price ?? old('price') }}" required 
                    style="width: 100%; padding: 0.75rem; border-radius: 0.5rem; border: 1px solid var(--border);">
            </div>
            <div>
                <label style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Initial Stock</label>
                <input type="number" name="stock" value="{{ $item->stock ?? old('stock', 0) }}" required 
                    style="width: 100%; padding: 0.75rem; border-radius: 0.5rem; border: 1px solid var(--border);">
            </div>
        </div>

        <div style="display: flex; gap: 1rem;">
            <button type="submit" class="btn btn-primary" style="flex: 1; justify-content: center;">
                {{ isset($item) ? 'Update Item' : 'Save Item' }}
            </button>
            <a href="{{ route('items.index') }}" class="btn" style="background: var(--border); color: var(--text-main); flex: 1; justify-content: center;">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection
