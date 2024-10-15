<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Note;

class NoteController extends Controller
{
    public function showAll()
    {
        $notes = Note::orderBy('updated_at', 'asc')->get();
        return view('notes', ['notes'=> $notes]);
    }

    public function createNote()
    {
        return view('create-note');
    }

    public function storeNote(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'content' => 'required|string|max:2000'

        ]);

        $note = new Note();
        $note->title = $validated['title'];
        $note->description = $validated['description'];
        $note->content = $validated['content'];
        $note->save();

        return redirect()->route('showAll')->with('success', 'Note created succesfully');

    }

    public function showNote(Request $request)
    {
        $note = Note::find($request->id);
        return view('note', ['note' => $note]);
    }

    public function editNote(Request $request)
    {
        $note = Note::find($request->id);
        return view('edit-note', ['note' => $note]);
    }

    public function updateNote(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'content' => 'required|string|max:2000'

        ]);

        $note = Note::find($request->id);
        $note->title = $validated['title'];
        $note->description = $validated['description'];
        $note->content = $validated['content'];
        $note->save();

        return redirect()->route('showNote', ['id' => $note->id])->with('success', 'Note updated succesfully');

    }

    public function deleteNote(Request $request)
    {
        $note = Note::find($request->id);
        $note->delete();

        return redirect()->route('showAll')->with('success', 'Note deleted succesfully');

    }
}
