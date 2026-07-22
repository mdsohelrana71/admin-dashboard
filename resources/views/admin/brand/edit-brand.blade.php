@extends('layouts.admin')

@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-white fw-bold">
        <i class="fas fa-edit"></i> Edit Brand
    </div>
    <div class="card-body">
        @if($errors->any())
            <div class="alert alert-danger">
                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('admin.product-brands.update', $brand->id) }}">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label class="form-label">Name</label>
                <input type="text" name="name" class="form-control" value="{{ $brand->name }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Logo</label>
                <input type="file" name="logo" class="form-control">
                @if($brand->logo)
                    <img src="{{ Storage::url($brand->logo) }}" alt="{{ $brand->name }}" class="img-thumbnail mt-2" style="max-width: 100px;">
                @endif
            </div>
            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea name="description" class="form-control">{{ $brand->description }}</textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Status</label>
                <select name="status" class="form-select">
                    <option value="0" {{ $brand->status == 0 ? 'selected' : '' }}>Inactive</option>
                    <option value="1" {{ $brand->status == 1 ? 'selected' : '' }}>Active</option>
                </select>
            </div>
            <button type="submit" class="btn btn-warning">
                <i class="fas fa-save"></i> Update Brand
            </button>
            <a href="{{ route('admin.product-brands.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
@endsection