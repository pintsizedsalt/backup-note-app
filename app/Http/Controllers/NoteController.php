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

        if ($search) {
            $query->where(function ($query) use ($search) {
                $query->where('title', 'LIKE', "%$search%")
                      ->orWhere('description', 'LIKE', "%$search%")
                      ->orWhere('content', 'LIKE', "%$search%");
            });
    }
        
        $notes = $query->orderBy('created_at', 'desc')->get();
        
        $noNotesMessage = $notes->isEmpty() ? "No notes found." : null;

        return view('notes', ['notes' => $notes, 'search' => $search, 'noNotesMessage' => $noNotesMessage]);
    }


    public function createNote()
    {
        return view('create-note');
    }

    public function storeNote(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:60',
            'description' => 'required|string|max:100',
            'content' => 'required|string|max:10000'
        ]);

        $note = new Note();
        $note->title = $validated['title'];
        $note->description = $validated['description'];
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
            'title' => 'required|string|max:60',
            'description' => 'required|string|max:100',
            'content' => 'required|string|max:10000'
        ]);

        $note = Note::find($request->id);

        if (!$note) {
            return redirect()->route('showAll')->with('error', 'Note not found.');
        }

        $note->title = $validated['title'];
        $note->description = $validated['description'];
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

        if ($note->is_bookmarked) {
            Log::info("Deleting a bookmarked note: " . $note->title);
        }

        $note->delete();

        session()->flash('message', 'Note moved to the trash bin.');
            
        return redirect()->route('showAll')->with('success', 'Note deleted successfully.'); // Default redirect to notes page

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

    public function showBookmarkedNotes(Request $request)
    {
        $search = $request->input('search', '');

        $query = Note::query()->where('is_bookmarked', true);

        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'LIKE', "%$search%")
                ->orWhere('description', 'LIKE', "%$search%")
                ->orWhere('content', 'LIKE', "%$search%");
            });
        }

        $notes = $query->orderBy('created_at', 'desc')->get();
        $noNotesMessage = $notes->isEmpty() && empty($search) ? "You don't have any bookmarked notes yet." : null;

        return view('bookmarked-notes', ['notes' => $notes, 'search' => $search, 'noNotesMessage' => $noNotesMessage]);
    }

    public function showTrash()
    {
        $trashedNotes = Note::onlyTrashed()->orderBy('deleted_at', 'desc')->get();
        return view('trash', ['notes' => $trashedNotes]);
    }

    public function deleteSelectedNotes(Request $request)
    {
        $noteIds = $request->input('note_ids', []);
        Log::info('Deleting notes with IDs: ' . implode(', ', $noteIds));
        
        if (empty($noteIds)) {
            return redirect()->route('showTrash')->with('no_delete', 'No selected items to delete.');
        }

        Note::onlyTrashed()->whereIn('id', $noteIds)->forceDelete();
        return redirect()->route('showTrash')->with('success', 'Selected notes deleted permanently.');
    }

    public function emptyTrash()
    {
        Note::onlyTrashed()->forceDelete();
        return redirect()->route('showTrash')->with('success', 'Trash bin emptied.');
    }

    public function restoreSelectedNotes(Request $request)
    {
        $noteIds = $request->input('note_ids', []);
        
        if (empty($noteIds)) {
            return redirect()->route('showTrash')->with('no_restore', 'No selected items to restore.');
        }

        Log::info('Restoring notes with IDs: ' . implode(', ', $noteIds));

        Note::withTrashed()->whereIn('id', $noteIds)->restore();

        return redirect()->route('showTrash')->with('success', 'Selected notes restored successfully.');
    }

}
