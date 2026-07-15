@extends('layouts.admin')

@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <span class="fw-bold"><i class="fas fa-user-shield"></i> All Admins</span>
        <a href="{{ route('admin.users.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-user-plus"></i> Add Admin
        </a>
    </div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-hover">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Created</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($admins as $admin)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $admin->name }}</td>
                    <td>{{ $admin->email }}</td>
                    <td><span class="badge bg-success">Admin</span></td>
                    <td>{{ $admin->created_at->format('d M Y') }}</td>
                    <td>
                        <a href="{{ route('admin.users.edit', $admin->id) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <button class="btn btn-danger btn-sm" onclick="deleteAdmin({{ $admin->id }})">
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
function deleteAdmin(id) {
    if (!confirm('Are you sure you want to delete this admin?')) return;
    fetch(`/admin/users/${id}`, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Content-Type': 'application/json'
        }
    }).then(response => response.json())
      .then(data => {
          document.querySelector(`button[onclick="deleteAdmin(${id})"]`).closest('tr').remove();
      });
}
</script>
@endsection