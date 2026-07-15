@extends('layouts.admin')

@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <span class="fw-bold"><i class="fas fa-table"></i> Data Tables - All Users</span>
        <a href="{{ route('admin.users.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-user-plus"></i> Add User
        </a>
    </div>
    <div class="card-body">
        <table class="table table-hover table-striped">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Registered</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @if($user->role == 'admin')
                            <span class="badge bg-success">Admin</span>
                        @else
                            <span class="badge bg-primary">User</span>
                        @endif
                    </td>
                    <td>{{ $user->created_at->format('d M Y') }}</td>
                    <td>
                        <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i>
                        </a>
                        <button class="btn btn-danger btn-sm" onclick="deleteUser({{ $user->id }})">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        {{-- Pagination --}}
        <div class="d-flex justify-content-center mt-3">
            {{ $users->links() }}
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
function deleteUser(id) {
    if (!confirm('Are you sure?')) return;
    fetch(`/admin/users/${id}`, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Content-Type': 'application/json'
        }
    }).then(response => response.json())
      .then(data => {
          document.querySelector(`button[onclick="deleteUser(${id})"]`).closest('tr').remove();
      });
}
</script>
@endsection