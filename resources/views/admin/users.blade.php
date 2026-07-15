@extends('layouts.admin')

@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <span class="fw-bold"><i class="fas fa-users"></i> Manage Users</span>
        <a href="{{ route('admin.users.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-user-plus"></i> Add User
        </a>
    </div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <input type="text" id="searchInput" class="form-control mb-3" placeholder="Search users by name or email...">

        <table class="table table-hover">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="usersTable">
                @foreach($users as $user)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <button class="btn btn-danger btn-sm" onclick="deleteUser({{ $user->id }})">
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
    fetch(`/admin/users/search?search=${search}`)
        .then(response => response.json())
        .then(users => {
            let html = '';
            users.forEach((user, index) => {
                html += `<tr>
                    <td>${index + 1}</td>
                    <td>${user.name}</td>
                    <td>${user.email}</td>
                    <td>
                        <a href="/admin/users/${user.id}/edit" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <button class="btn btn-danger btn-sm" onclick="deleteUser(${user.id})">
                            <i class="fas fa-trash"></i> Delete
                        </button>
                    </td>
                </tr>`;
            });
            document.getElementById('usersTable').innerHTML = html;
        });
});

function deleteUser(id) {
    if (!confirm('Are you sure you want to delete this user?')) return;
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