<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trash Bin</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
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
            <li><a href="{{ route('showBookmarkedNotes') }}" class="nav-link">Bookmarks</a></li>
            <li><a href="{{ route('showAll') }}" class="nav-link">My Notes</a></li>
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

        <div>
            @foreach ($notes as $note)
                <div class="note">
                    <label>
                        <input type="checkbox" name="note_ids[]" value="{{ $note->id }}" class="note-checkbox">
                        <div class="note-title">{{ $note->title }}</div>
                        <div class="note-content">{{ $note->content }}</div>
                    </label>
                    <hr>
                </div>
            @endforeach
        </div>

        <div class="button-group-trash">
        <form action="{{ route('deleteSelectedNotes') }}" method="POST" id="delete-selected-form" onsubmit="return confirm('Are you sure?')">
            @csrf
            @method("DELETE")
            <button type="submit" class="btn" style="display: none;" id="delete-selected-button">
                Delete Selected
            </button>
        </form>

        <form action="{{ route('emptyTrash') }}" method="POST" onsubmit="return confirm('Are you sure you want to empty your trash bin? This will be permanently deleted.')">
            @csrf
            @method("DELETE")
            <button type="submit" class="btn">Empty Trash Bin</button>
        </form>
        </div>

        <script>
            const checkboxes = document.querySelectorAll('.note-checkbox');
            const deleteButton = document.getElementById('delete-selected-button');

            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', () => {
                    const anyChecked = Array.from(checkboxes).some(checkbox => checkbox.checked);
                    deleteButton.style.display = anyChecked ? 'block' : 'none';
                });
            });
        </script>
    </div>
</body>
</html>
