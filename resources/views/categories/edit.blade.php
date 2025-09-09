@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="fw-bold">✏️ Edit Category</h1>
            <a href="{{ route('categories.index') }}" class="btn btn-outline-secondary shadow-sm">
                ⬅️ Back to Categories
            </a>
        </div>

        @if($errors->any())
            <div class="alert alert-danger shadow-sm">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>⚠️ {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card shadow-sm rounded-3">
            <div class="card-body">
                <form action="{{ route('categories.update', $category) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="name" class="form-label fw-semibold">Category Name</label>
                        <input type="text" name="name" id="name" class="form-control"
                               value="{{ $category->name }}" required>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-success shadow-sm">
                            💾 Update
                        </button>
                        <a href="{{ route('categories.index') }}" class="btn btn-secondary shadow-sm">
                            ❌ Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>

    </div>
@endsection
