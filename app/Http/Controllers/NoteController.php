<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class NoteController extends Controller
{
    public function index(Request $request)
    {
        $query = Note::where('user_id', auth()->id());

        if ($search = $request->input('q')) {
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('content', 'like', "%{$search}%");
            });
        }

        $notes = $query->latest()->get();
        $categories = Category::all();
        return view('notes.index', compact('notes', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('notes.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'nullable|exists:categories,id',
            'password' => 'nullable|string|min:4',
        ]);

        $data = $request->only('title', 'content', 'category_id');

        if ($request->filled('password')) {
            $data['is_protected'] = true;
            $data['password'] = Hash::make($request->password);
        } else {
            $data['is_protected'] = false;
            $data['password'] = null;
        }

        auth()->user()->notes()->create($data);

        return redirect()->route('notes.index')->with('success', 'Note created successfully.');
    }

    public function show(Note $note, Request $request)
    {
        $this->authorize('view', $note);

        if ($note->is_protected && !$request->session()->has("unlocked_note_{$note->id}")) {
            return view('notes.unlock', compact('note'));
        }

        return view('notes.show', compact('note'));
    }

    public function unlock(Request $request, Note $note)
    {
        $request->validate([
            'password' => 'required|string',
        ]);

        if ($note->password && Hash::check($request->password, $note->password)) {
            $request->session()->put("unlocked_note_{$note->id}", true);
            return redirect()->route('notes.show', $note);
        }

        return back()->withErrors(['password' => 'Parol noto‘g‘ri!']);
    }

    public function edit(Note $note)
    {
        $this->authorize('update', $note);
        $categories = Category::all();
        return view('notes.edit', compact('note', 'categories'));
    }

    public function update(Request $request, Note $note)
    {
        $this->authorize('update', $note);

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'nullable|exists:categories,id',
            'password' => 'nullable|string|min:4',
        ]);

        $data = $request->only('title', 'content', 'category_id');

        if ($request->filled('password')) {
            $data['is_protected'] = true;
            $data['password'] = Hash::make($request->password);
        } else {
            $data['is_protected'] = false;
            $data['password'] = null;
        }

        $note->update($data);

        return redirect()->route('notes.index')->with('success', 'Note updated successfully.');
    }

    public function destroy(Note $note)
    {
        $this->authorize('delete', $note);
        $note->delete();
        return redirect()->route('notes.index')->with('success', 'Note deleted successfully.');
    }

    public function pin(Note $note)
    {
        $this->authorize('update', $note);
        $note->update(['is_pinned' => ! $note->is_pinned]);
        return back()->with('success', 'Note pinned successfully.');
    }

    public function archive(Note $note)
    {
        $this->authorize('update', $note);
        $note->update(['is_archived' => ! $note->is_archived]);
        return back()->with('success', 'Note archived successfully.');
    }
}
