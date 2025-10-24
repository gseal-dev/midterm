@extends('layout')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Categories</h2>
    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
        <i class="bi bi-plus-circle"></i> Add Category
    </button>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <table class="table table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th width="120">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($categories->reverse() as $c)
                <tr>
                    <td>{{ $c->id }}</td>
                    <td>{{ $c->name }}</td>
                    <td>{{ $c->description ?? '-' }}</td>
                    <td>
                        <a class="btn btn-warning btn-sm" href="{{ route('categories.edit', $c->id) }}" title="Edit">
                            <i class="bi bi-pencil-square"></i>
                        </a>
                        <form class="d-inline" action="{{ route('categories.destroy', $c->id) }}" method="POST">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Delete this category?')" title="Delete">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="4" class="text-center text-muted">No categories found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- 🟢 Add Category Modal -->
<div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form action="{{ route('categories.store') }}" method="POST" class="modal-content">
        @csrf
        <div class="modal-header">
            <h5 class="modal-title" id="addCategoryModalLabel">Add Category</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="mb-3">
                <label class="form-label">Category Name</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea name="description" class="form-control" rows="3"></textarea>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-success">Save</button>
        </div>
    </form>
  </div>
</div>
@endsection
