@extends('layout')

@section('content')
<h2>Edit Category</h2>
<div class="card p-3 shadow-sm">
    <form action="{{ route('categories.update', $category->id) }}" method="POST">
        @csrf @method('PUT')

        <div class="mb-3">
            <label class="form-label">Category Name</label>
            <input type="text" name="name" 
                   class="form-control @error('name') is-invalid @enderror" 
                   value="{{ old('name', $category->name) }}" required>
            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" 
                      class="form-control @error('description') is-invalid @enderror" 
                      rows="3">{{ old('description', $category->description) }}</textarea>
            @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <button class="btn btn-primary">Update</button>
        <a href="{{ route('categories.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
