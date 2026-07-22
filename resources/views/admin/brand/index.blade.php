@extends('layouts.admin')

@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <span class="fw-bold"><i class="fas fa-tags"></i> Manage Brands</span>
        <a href="{{ route('admin.product-brands.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-tag"></i> Add Brand
        </a>
    </div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <input type="text" id="searchInput" class="form-control mb-3" placeholder="Search brands by name...">

        <table class="table table-hover">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Logo</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="brandsTable">
                @foreach($brands as $brand)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $brand->name }}</td>
                    <td>
                        @if($brand->logo)
                            <img src="{{ Storage::url($brand->logo) }}" alt="{{ $brand->name }}" class="img-thumbnail" style="max-width: 50px;">
                        @endif
                    </td>
                    <td>{{ Str::limit($brand->description, 100) }}</td>
                    <td>
                        <a href="{{ route('admin.product-brands.edit', $brand->id) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <button class="btn btn-danger btn-sm" onclick="deleteBrand({{ $brand->id }})">
                            <i class="fas fa-trash"></i> Delete
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.getElementById('searchInput').addEventListener('keyup', function() {
    let search = this.value;
    fetch(`/admin/product-brands/search?search=${search}`)
        .then(response => response.json())
        .then(brands => {
            let html = '';
            users.forEach((user, index) => {
                html += `<tr>
                    <td>${index + 1}</td>
                    <td>${brand.name}</td>
                    <td>${brand.email}</td>
                    <td>
                        <a href="/admin/product-brands/${brand.id}/edit" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <button class="btn btn-danger btn-sm" onclick="deleteBrand(${brand.id})">
                            <i class="fas fa-trash"></i> Delete
                        </button>
                    </td>
                </tr>`;
            });
            document.getElementById('brandsTable').innerHTML = html;
        });
});

function deleteBrand(id) {
    if (!confirm('Are you sure you want to delete this brand?')) return;
    fetch(`/admin/product-brands/${id}`, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Content-Type': 'application/json'
        }
    }).then(response => response.json())
      .then(data => {
          document.querySelector(`button[onclick="deleteBrand(${id})"]`).closest('tr').remove();
      });
}
</script>
@endsection