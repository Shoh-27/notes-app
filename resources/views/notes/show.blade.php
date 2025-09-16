@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card shadow-sm">
            <div class="card-body">
                <h3>{{ $note->title }}</h3>
                <p class="text-muted">
                    Category: {{ $note->category?->name ?? 'No category' }}
                </p>

                @if($note->is_protected)
                    @if(session()->has("unlocked_note_{$note->id}"))
                        <!-- Note content ko‘rsatish -->
                        <p>{{ $note->content }}</p>
                    @else
                        <!-- Agar parol kiritilmagan bo‘lsa -->
                        <div class="alert alert-warning">
                            🔒 This note is protected. Please enter password to unlock.
                        </div>
                        <a href="{{ route('notes.unlock', $note) }}" class="btn btn-primary">
                            Enter Password
                        </a>
                    @endif
                @else
                    <!-- Himoya qilinmagan note -->
                    <p>{{ $note->content }}</p>
                @endif
            </div>
        </div>
    </div>
@endsection

