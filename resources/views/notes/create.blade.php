@extends('layouts.app')

@section('content')
    <h1 class="text-xl font-bold mb-4">✍️ Yangi Note qo‘shish</h1>

    <form action="{{ route('notes.store') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label class="block font-semibold">Sarlavha</label>
            <input type="text" name="title" value="{{ old('title') }}" required
                   class="w-full border rounded px-3 py-2">
            @error('title')
            <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block font-semibold">Kontent</label>
            <textarea name="content" rows="5" required
                      class="w-full border rounded px-3 py-2">{{ old('content') }}</textarea>
            @error('content')
            <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block font-semibold">Kategoriya</label>
            <select name="category_id" class="w-full border rounded px-3 py-2">
                <option value="">Tanlanmagan</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" @selected(old('category_id') == $category->id)>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- 🔒 Parol qo‘yish -->
        <div>
            <label class="block font-semibold">Parol (ixtiyoriy)</label>
            <div class="flex">
                <input type="password" id="password" name="password"
                       class="w-full border rounded-l px-3 py-2"
                       placeholder="Agar note’ni himoyalamoqchi bo‘lsangiz parol kiriting">
                <button type="button" onclick="togglePassword()"
                        class="bg-gray-200 px-3 rounded-r">👁️</button>
            </div>
            @error('password')
            <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <button class="bg-blue-500 text-white px-4 py-2 rounded">Saqlash</button>
        <a href="{{ route('notes.index') }}" class="ml-2 text-gray-600">Bekor qilish</a>
    </form>

    <script>
        function togglePassword() {
            const input = document.getElementById('password');
            input.type = input.type === 'password' ? 'text' : 'password';
        }
    </script>
@endsection
