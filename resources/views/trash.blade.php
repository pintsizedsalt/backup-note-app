<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trash Bin</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
</head>
<body>

    <input type="checkbox" id="menu-toggle" class="menu-toggle">
    <label for="menu-toggle" class="menu-icon">
        <span></span>
        <span></span>
        <span></span>
    </label>

    <nav class="drawer">
        <ul>
            <li><a href="{{ route('showAll') }}" class="nav-link">My Notes</a></li>
            <li><a href="{{ route('showBookmarkedNotes') }}" class="nav-link">Bookmarks</a></li>
            <li><a href="{{ route('showTrash') }}" class="nav-link active">Trash Bin</a></li>
        </ul>
    </nav>

    <div class="container">
        <h1>Trash Bin</h1>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @elseif(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        @if ($notes->isEmpty())
            <div class="no-notes-message">
                <h2>Your Trash Bin is Empty</h2>
                <p>It looks like there are no notes in your trash. When you delete notes, they'll appear here for you to restore or permanently delete.</p>
                <a href="{{ route('showAll') }}" class="btn">Go to My Notes</a>
            </div>
        @else
            <div class="button-group-trash">
                <form action="{{ route('emptyTrash') }}" method="POST" onsubmit="return confirm('Are you sure you want to empty your trash bin? This will be permanently deleted.')" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn">Empty Trash Bin</button>
                </form>

                <form action="{{ route('deleteSelectedNotes') }}" method="POST" id="delete-selected-form" onsubmit="return confirm('Are you sure?')" style="display: inline;">
                    @csrf
                    @method('DELETE')

                    <div>
                        @foreach ($notes as $note)
                            <div class="note" data-note-id="{{ $note->id }}">
                                <label>
                                    <input type="checkbox" name="note_ids[]" value="{{ $note->id }}" class="note-checkbox">
                                    <div class="note-title">{{ $note->title }}</div>
                                    <div class="note-content">{{ $note->content }}</div>
                                </label>
                                <hr>
                            </div>
                        @endforeach
                    </div>

                    <div class="button-group">
                        <button type="submit" class="btn" style="display: none;" id="delete-selected-button">Delete</button>
                    </div>
                </form>

                <form action="{{ route('restoreSelectedNotes') }}" method="POST" id="restore-selected-form">
                    @csrf
                    <div id="restore-notes-container"></div>
                    <button type="submit" class="btn" style="display: none;" id="restore-selected-button">Restore</button>
                </form>
            </div>
        @endif

        <script>
            const checkboxes = document.querySelectorAll('.note-checkbox');
            const deleteButton = document.getElementById('delete-selected-button');
            const restoreForm = document.getElementById('restore-selected-form');
            const restoreButton = document.getElementById('restore-selected-button');
            const restoreContainer = document.getElementById('restore-notes-container');

            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', () => {
                    const anyChecked = Array.from(checkboxes).some(cb => cb.checked);
                    deleteButton.style.display = anyChecked ? 'block' : 'none';
                    restoreButton.style.display = anyChecked ? 'block' : 'none';

                    restoreContainer.innerHTML = '';
                    checkboxes.forEach(cb => {
                        if (cb.checked) {
                            const input = document.createElement('input');
                            input.type = 'hidden';
                            input.name = 'note_ids[]';
                            input.value = cb.value;
                            restoreContainer.appendChild(input);
                        }
                    });
                });
            });

            restoreForm.addEventListener('submit', function(event) {
                event.preventDefault(); // Prevent form submission
                const selectedNotes = Array.from(checkboxes).filter(cb => cb.checked);
                selectedNotes.forEach(checkbox => {
                    const noteDiv = checkbox.closest('.note');
                    const noteId = noteDiv.dataset.noteId;
                    
                    // Here you would typically send a request to the server to restore the note.
                    // For demonstration, we'll simply remove it from the DOM.
                    if (noteId) {
                        // Simulate the restoration process
                        fetch(`{{ route('restoreSelectedNotes') }}`, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify({ note_ids: [noteId] })
                        }).then(response => {
                            // If the note is successfully restored, remove it from the DOM
                            if (response.ok) {
                                noteDiv.remove(); // Remove the restored note from the DOM
                            } else {
                                alert('Error restoring the note. Please try again.');
                            }
                        });
                    }
                });

                // Clear checkboxes and hide buttons
                selectedNotes.forEach(cb => cb.checked = false);
                deleteButton.style.display = 'none';
                restoreButton.style.display = 'none';
                restoreContainer.innerHTML = '';
            });
        </script>
    </div>
</body>
</html>
