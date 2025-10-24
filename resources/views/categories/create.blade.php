@extends('layout')

@section('content')
<h2>Add Category</h2>
<div class="card p-3 shadow-sm">
    <form action="{{ route('categories.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label">Category Name</label>
            <input type="text" name="name" 
                   class="form-control @error('name') is-invalid @enderror" 
                   value="{{ old('name') }}" required>
            @error('name') 
                <div class="invalid-feedback">{{ $message }}</div> 
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" 
                      class="form-control @error('description') is-invalid @enderror" 
                      rows="3">{{ old('description') }}</textarea>
            @error('description') 
                <div class="invalid-feedback">{{ $message }}</div> 
            @enderror
        </div>

        <button class="btn btn-success">Save</button>
        <a href="{{ route('categories.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
