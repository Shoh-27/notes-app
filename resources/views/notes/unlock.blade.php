<!-- unlock.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>This note is protected</h3>
        <form method="POST" action="{{ route('notes.unlock', $note) }}">
            @csrf
            <input type="password" name="password" class="form-control" placeholder="Enter password">
            <button type="submit" class="btn btn-primary mt-2">Unlock</button>
        </form>
    </div>
@endsection

