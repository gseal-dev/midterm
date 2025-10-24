@extends('layout')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="fw-bold">Products List</h2>
    <a href="{{ route('products.create') }}" class="btn btn-success">
        <i class="bi bi-plus-circle"></i> Add New
    </a>
</div>




<div class="card shadow-sm">
    <div class="card-body p-0">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-dark">
                <tr>
                    <th>Sr#</th>
                    <th>Image</th> {{-- Added Image column --}}
                    <th>Name</th>
                    <th>Category</th>
                    <th>Pur Price</th>
                    <th>Sale Price</th>
                    <th>Stock</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $index => $p)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    
                    {{-- Display product image with modal preview --}}
                    <td>
                        @if($p->image)
                            <a href="#" data-bs-toggle="modal" data-bs-target="#imageModal{{ $p->id }}">
                                <img src="{{ asset('storage/'.$p->image) }}" 
                                     alt="{{ $p->name }}" width="100" class="img-thumbnail">
                            </a>

                            <!-- Modal -->
                            <div class="modal fade" id="imageModal{{ $p->id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content bg-transparent border-0">
                                        <div class="modal-body text-center">
                                            <button type="button" class="btn-close btn-close-white position-absolute top-0 end-0 m-2" data-bs-dismiss="modal" aria-label="Close"></button>
                                            <img src="{{ asset('storage/'.$p->image) }}" 
                                                 alt="{{ $p->name }}" class="img-fluid rounded shadow">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            -
                        @endif
                    </td>

                    <td>{{ $p->name }}</td>
                    <td>{{ $p->category->name ?? '-' }}</td>
                    <td>{{ number_format($p->purchase_price,2) }}</td>
                    <td>{{ number_format($p->sale_price,2) }}</td>
                    <td>{{ $p->stock }}</td>
                    <td class="text-center">
                        <a href="{{ route('products.edit', $p->id) }}" class="btn btn-warning btn-sm" title="Edit">
                            <i class="bi bi-pencil-square"></i>
                        </a>
                        <form action="{{ route('products.destroy', $p->id) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Delete this product?')" title="Delete">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center text-muted py-3">No products found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- ✅ Bootstrap JS para gumana ang modal at dismissible alert --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@endsection
