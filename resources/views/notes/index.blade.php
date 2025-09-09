<x-app-layout>
    <h1 class="text-xl font-bold mb-4">Mening Notelarim</h1>

    <form method="GET" action="{{ route('notes.index') }}" class="mb-4">
        <input type="text" name="q" value="{{ request('q') }}"
               placeholder="Qidiruv..."
               class="border rounded px-3 py-2 w-1/2">
        <button class="bg-gray-500 text-white px-4 py-2 rounded">Qidirish</button>
    </form>


    <a href="{{ route('notes.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Yangi note</a>

    <ul class="mt-4">
        @foreach ($notes as $note)
            <li class="border p-2 mb-2 {{ $note->is_pinned ? 'bg-yellow-100' : '' }}">
                <h2 class="font-semibold">
                    {{ $note->title }}
                    @if($note->is_pinned) 📌 @endif
                    @if($note->is_archived) 🗄️ @endif
                </h2>
                <p>{{ $note->content }}</p>
                <small>Kategoriya: {{ $note->category->name ?? '—' }}</small><br>

                <a href="{{ route('notes.edit', $note) }}" class="text-blue-600">✏️ Edit</a>

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

</x-app-layout>
