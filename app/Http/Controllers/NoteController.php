<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Note;
use Illuminate\Support\Facades\Log;

class NoteController extends Controller
{
    public function showAll(Request $request)
    {
        $search = $request->input('search', '');

        $query = Note::query();

        if ($search)
        {
            $query -> where('title', 'LIKE', "%$search%")
            ->orWhere('content', 'LIKE', "%$search%")
            ->get();
        }
        
        $notes = $query->get();
        
        return view('notes', ['notes' => $notes, 'search' => $search]);
    }


    public function createNote()
    {
        return view('create-note');
    }

    public function storeNote(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string|max:10000'
        ]);

        $note = new Note();
        $note->title = $validated['title'];
        $note->content = $validated['content'];
        $note->save();

        return redirect()->route('showAll')->with('success', 'Note created successfully');
    }

    public function showNote(Request $request)
    {
        $note = Note::find($request->id);

        if (!$note) {
            return redirect()->route('showAll')->with('error', 'Note not found.');
        }

        return view('note', ['note' => $note]);
    }

    public function editNote(Request $request)
    {
        $note = Note::find($request->id);

        if (!$note) {
            return redirect()->route('showAll')->with('error', 'Note not found.');
        }

        return view('edit-note', ['note' => $note]);
    }

    public function updateNote(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string|max:10000'
        ]);

        $note = Note::find($request->id);

        if (!$note) {
            return redirect()->route('showAll')->with('error', 'Note not found.');
        }

        $note->title = $validated['title'];
        $note->content = $validated['content'];
        $note->save();

        return redirect()->route('showNote', ['id' => $note->id])->with('success', 'Note updated successfully');
    }

    public function deleteNote(Request $request)
    {
        $note = Note::find($request->id);
        if (!$note) {
            return redirect()->route('showAll')->with('error', 'Note not found.');
        }
        $note->delete();
        return redirect()->route('showAll')->with('success', 'Note deleted successfully');
    }

    public function toggleBookmark(Request $request)
    {
        $note = Note::find($request->id);

        if ($note) {
            $note->is_bookmarked = !$note->is_bookmarked; 
            $note->save();

            $message = $note->is_bookmarked ? 'Note bookmarked!' : 'Note unbookmarked!';
            session()->flash('status', $message);
        }

        return back();  
    }


    public function showBookmarkedNotes()
    {
        $bookmarkedNotes = Note::where('is_bookmarked', true)->get();

        return view('bookmarked-notes', [
            'notes' => $bookmarkedNotes,
            'noNotesMessage' => $bookmarkedNotes->isEmpty() ? "No bookmarked notes found." : null
        ]);
    }


    public function showTrash()
    {
        $trashedNotes = Note::onlyTrashed()->get();
        return view('trash', ['notes' => $trashedNotes]);
    }

    public function deleteSelectedNotes(Request $request)
    {
        Log::info('Request method: ' . $request->method()); 
        $noteIds = $request->input('note_ids', []);
        session(['selected_ids' => $noteIds]); 

        Note::onlyTrashed()->whereIn('id', $noteIds)->forceDelete();
        return redirect()->route('showTrash')->with('success', 'Selected notes deleted permanently.');

    }


    public function emptyTrash()
    {
        Note::onlyTrashed()->forceDelete();
        return redirect()->route('showTrash')->with('success', 'Trash bin emptied.');
    }
}
