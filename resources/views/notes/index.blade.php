@extends('layouts.app')
@section('content')
    <h1 class="text-xl font-bold mb-4">Mening Notelarim</h1>

    <form method="GET" action="{{ route('notes.index') }}" class="mb-4">
        <input type="text" name="q" value="{{ request('q') }}"
               placeholder="Qidiruv..."
               class="border rounded px-3 py-2 w-1/2">
        <button class="bg-gray-500 text-white px-4 py-2 rounded">Qidirish</button>
    </form>

    @if(auth()->user()->role === 'admin')
        <div class="mb-3">
            <a href="{{ route('categories.create') }}" class="btn btn-primary">
                + Add New Category
            </a>
            <a href="{{ route('categories.index') }}" class="btn btn-outline-secondary">
                Manage Categories
            </a>
        </div>
    @endif


    <a href="{{ route('notes.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Yangi note</a>

    <ul class="mt-4">
        @foreach ($notes as $note)
            <li class="border p-2 mb-2 {{ $note->is_pinned ? 'bg-yellow-100' : '' }}">
                <h2 class="font-semibold">
                    {{ $note->title }}
                    @if($note->is_pinned) 📌 @endif
                    @if($note->is_archived) 🗄️ @endif
                </h2>
                <small>Kategoriya: {{ $note->category->name ?? '—' }}</small><br>

                <a href="{{ route('notes.edit', $note) }}" class="text-blue-600">✏️ Edit</a>
                <a href="{{ route('notes.show', $note) }}"
                   class="inline-block mt-2 bg-blue-600 hover:bg-blue-500 text-white px-3 py-1 rounded">
                    📖 Ko‘rish
                </a>

                <form action="{{ route('notes.destroy', $note) }}" method="POST" class="inline">
                    @csrf @method('DELETE')
                    <button class="text-red-600">🗑️ Delete</button>
                </form>

                <form action="{{ route('notes.pin', $note) }}" method="POST" class="inline">
                    @csrf @method('PATCH')
                    <button class="text-yellow-600">{{ $note->is_pinned ? 'Unpin' : 'Pin' }}</button>
                </form>

                <form action="{{ route('notes.archive', $note) }}" method="POST" class="inline">
                    @csrf @method('PATCH')
                    <button class="text-gray-600">{{ $note->is_archived ? 'Unarchive' : 'Archive' }}</button>
                </form>
            </li>
        @endforeach
    </ul>
@endsection
