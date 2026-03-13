@extends('layouts.inventory')

@section('title', 'Items List')
@section('header', 'Items Inventory')

@section('actions')
<a href="{{ route('items.create') }}" class="btn btn-primary">
    <i class="fas fa-plus" style="margin-right: 8px;"></i> Add New Item
</a>
@endsection

@section('content')
<div class="glass-card">
    <div class="table-container" style="margin-top: 0;">
        <table>
            <thead>
                <tr>
                    <th>SKU</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th style="text-align: right;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($items as $item)
                <tr>
                    <td><code>{{ $item->sku }}</code></td>
                    <td style="font-weight: 500;">{{ $item->name }}</td>
                    <td>{{ $item->category->name }}</td>
                    <td>Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                    <td>
                        <span class="badge {{ $item->stock < 10 ? 'badge-danger' : 'badge-success' }}">
                            {{ $item->stock }}
                        </span>
                    </td>
                    <td style="text-align: right;">
                        <a href="{{ route('items.edit', $item) }}" class="btn" style="color: var(--primary); padding: 0.25rem 0.5rem;">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('items.destroy', $item) }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn" style="color: var(--danger); background: none; padding: 0.25rem 0.5rem;" onclick="return confirm('Delete this item?')">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="text-align: center; padding: 3rem; color: var(--text-muted);">
                        No items found in inventory.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
