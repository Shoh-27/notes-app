@extends('layouts.app')

@section('content')
    <div class="container d-flex justify-content-center align-items-center" style="height: 70vh;">
        <div class="card shadow-lg" style="width: 400px; border-radius: 15px;">
            <div class="card-body text-center">
                <h4 class="mb-3">🔒 This note is protected</h4>
                <p class="text-muted">Enter the password to unlock</p>

                @if($errors->any())
                    <div class="alert alert-danger">
                        {{ $errors->first('password') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('notes.unlock', $note) }}">
                    @csrf
                    <div class="mb-3">
                        <input type="password" name="password" class="form-control form-control-lg text-center"
                               placeholder="••••••" autofocus>
                    </div>
                    <button type="submit" class="btn btn-primary btn-lg w-100" style="border-radius: 10px;">
                        Unlock Note
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection


