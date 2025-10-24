@extends('layout')

@section('content')
<h2>Edit Product</h2>
<div class="card p-3 shadow-sm">
    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')

        <div class="mb-3">
            <label class="form-label">Category</label>
            <select name="category_id" class="form-select @error('category_id') is-invalid @enderror" required>
                <option value="">-- choose category --</option>
                @foreach($categories as $c)
                    <option value="{{ $c->id }}" {{ (old('category_id', $product->category_id)==$c->id) ? 'selected':'' }}>{{ $c->name }}</option>
                @endforeach
            </select>
            @error('category_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Product name</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" 
                   value="{{ old('name', $product->name) }}" required>
            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Purchase Price</label>
                <input type="number" step="0.01" name="purchase_price" 
                       class="form-control @error('purchase_price') is-invalid @enderror" 
                       value="{{ old('purchase_price', $product->purchase_price) }}" required>
                @error('purchase_price') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Sale Price</label>
                <input type="number" step="0.01" name="sale_price" 
                       class="form-control @error('sale_price') is-invalid @enderror" 
                       value="{{ old('sale_price', $product->sale_price) }}" required>
                @error('sale_price') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Stock</label>
            <input type="number" name="stock" 
                   class="form-control @error('stock') is-invalid @enderror" 
                   value="{{ old('stock', $product->stock) }}" required>
            @error('stock') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Image</label>
            <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
            @if($product->image)
                <div class="mt-2">
                    <img src="{{ asset('storage/'.$product->image) }}" alt="Product Image" width="120">
                </div>
            @endif
            @error('image') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <button class="btn btn-primary">Update</button>
        <a href="{{ route('products.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
