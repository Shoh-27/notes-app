@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="fw-bold">📂 Categories</h1>

            <a href="{{ route('categories.create') }}" class="btn btn-success shadow-sm">
                ➕ Add Category
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success shadow-sm">
                ✅ {{ session('success') }}
            </div>
        @endif

        <div class="card shadow-sm rounded-3">
            <div class="card-body p-0">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                    <tr>
                        <th style="width: 60px;">#</th>
                        <th>Name</th>
                        <th style="width: 220px;">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($categories as $category)
                        <tr>
                            <td class="text-muted">{{ $loop->iteration }}</td>
                            <td>
                                <span class="badge bg-primary fs-6">
                                    {{ $category->name }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('categories.edit', $category) }}"
                                   class="btn btn-sm btn-warning me-1 shadow-sm">
                                    ✏️ Edit
                                </a>

                                <form action="{{ route('categories.destroy', $category) }}"
                                      method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button onclick="return confirm('Delete this category?')"
                                            class="btn btn-sm btn-danger shadow-sm">
                                        🗑️ Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center text-muted py-3">
                                No categories yet.
                            </td>
                        </tr>
                    @endforelse


                    </tbody>
                </table>
            </div>
        </div>
        <a href="{{ route('notes.index') }}" class="btn btn-secondary shadow-sm">
            ❌ Cancel
        </a>
    </div>
@endsection
