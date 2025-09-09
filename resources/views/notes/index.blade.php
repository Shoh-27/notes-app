<x-app-layout>
    <h1 class="text-xl font-bold mb-4">Mening Notelarim</h1>

    <a href="{{ route('notes.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Yangi note</a>

    <ul class="mt-4">
        @foreach ($notes as $note)
            <li class="border p-2 mb-2">
                <h2 class="font-semibold">{{ $note->title }}</h2>
                <p>{{ $note->content }}</p>
                <a href="{{ route('notes.edit', $note) }}" class="text-blue-600">✏️ Edit</a>
                <form action="{{ route('notes.destroy', $note) }}" method="POST" class="inline">
                    @csrf @method('DELETE')
                    <button class="text-red-600">🗑️ Delete</button>
                </form>
            </li>
        @endforeach
    </ul>
</x-app-layout>
