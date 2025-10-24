@extends('layout')

@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-dark text-white">
        <h5 class="mb-0">Add Product</h5>
    </div>
    <div class="card-body">

    

        {{-- SINGLE FORM WITH FILE UPLOAD --}}
        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- Product ID (auto, readonly) --}}
            <div class="mb-3">
                <label class="form-label">ID</label>
                <input type="text" class="form-control" value="Auto-generated" readonly>
            </div>

            {{-- Category --}}
            <div class="mb-3">
                <label class="form-label">Category</label>
                <select name="category_id" class="form-select @error('category_id') is-invalid @enderror" required>
                    <option value="">-- choose category --</option>
                    @foreach($categories as $c)
                        <option value="{{ $c->id }}" {{ old('category_id')==$c->id ? 'selected':'' }}>
                            {{ $c->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id') 
                    <div class="invalid-feedback">{{ $message }}</div> 
                @enderror
            </div>

            {{-- Product Name --}}
            <div class="mb-3">
                <label class="form-label">Name</label>
                <input type="text" name="name" 
                       class="form-control @error('name') is-invalid @enderror" 
                       value="{{ old('name') }}" required>
                @error('name') 
                    <div class="invalid-feedback">{{ $message }}</div> 
                @enderror
            </div>

            {{-- Prices and Stock --}}
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label">Purchase Price</label>
                    <input type="number" step="0.01" name="purchase_price" 
                           class="form-control @error('purchase_price') is-invalid @enderror" 
                           value="{{ old('purchase_price') ?? 0 }}" required>
                    @error('purchase_price') 
                        <div class="invalid-feedback">{{ $message }}</div> 
                    @enderror
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">Sale Price</label>
                    <input type="number" step="0.01" name="sale_price" 
                           class="form-control @error('sale_price') is-invalid @enderror" 
                           value="{{ old('sale_price') ?? 0 }}" required>
                    @error('sale_price') 
                        <div class="invalid-feedback">{{ $message }}</div> 
                    @enderror
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">Stock</label>
                    <input type="number" name="stock" 
                           class="form-control @error('stock') is-invalid @enderror" 
                           value="{{ old('stock') ?? 0 }}" required>
                    @error('stock') 
                        <div class="invalid-feedback">{{ $message }}</div> 
                    @enderror
                </div>
            </div>

            {{-- Product Image --}}
            <div class="mb-3">
                <label class="form-label">Product Image</label>
                <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
                @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Buttons --}}
            <div class="d-flex justify-content-end">
                <a href="{{ route('products.index') }}" class="btn btn-secondary me-2">
                    <i class="bi bi-arrow-left"></i> Cancel
                </a>
                <button type="submit" class="btn btn-success">
                    <i class="bi bi-save"></i> Save
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
