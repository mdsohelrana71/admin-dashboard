@extends('layouts.admin')

@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-white fw-bold">
        <i class="fas fa-user-plus"></i> Add New Brand
    </div>
    <div class="card-body">
        @if($errors->any())
            <div class="alert alert-danger">
                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('admin.product-brands.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label class="form-label">Name</label>
                <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Logo</label>
                <input type="file" name="logo" class="form-control" value="{{ old('logo') }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea type="text" name="description" class="form-control" value="{{ old('description') }}"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Save Brand
            </button>
            <a href="{{ route('admin.product-brands.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
@endsection