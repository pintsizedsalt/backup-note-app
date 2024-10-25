<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trash Bin</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
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
        <header class="logo">
            <a href="{{ route('showAll') }}">
                <img src="{{ asset('images/datadump.png') }}" alt="Data Dump Logo" class="logo-img">
            </a>
        </header>

        <h1>Trash Bin</h1>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @elseif(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        @if ($notes->isEmpty())
            <section class="no-notes-message">
                <h2>Your Trash Bin is Empty</h2>
                <p>It looks like there are no notes in your trash. When you delete notes, they'll appear here for you to restore or permanently delete.</p>
                <a href="{{ route('showAll') }}" class="btn-homepage">Go to My Notes</a>
            </section>
        @else
            <section class="trash-notes">
                <div class="button-group-trash" style="display: flex; gap: 10px; align-items: center;">
                    <form action="{{ route('emptyTrash') }}" method="POST" onsubmit="return confirm('Are you sure you want to empty your trash bin? This will be permanently deleted.')" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-homepage"><i class="fa-solid fa-trash-can"></i> Empty Trash</button>
                    </form>

                    <form action="{{ route('deleteSelectedNotes') }}" method="POST" id="delete-selected-form" onsubmit="return confirm('Are you sure you want to delete this? This will be permanently deleted.')" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-homepage" id="delete-selected-button" style="display: none;">
                            <i class="fa-regular fa-trash-can"></i> Delete Forever
                        </button>
                    </form>

                    <form action="{{ route('restoreSelectedNotes') }}" method="POST" id="restore-selected-form" style="display: inline;">
                        @csrf
                        <div id="restore-notes-container"></div>
                        <button type="submit" class="btn-homepage" id="restore-selected-button" style="display: none;">
                            <i class="fa-solid fa-trash-can-arrow-up"></i> Restore
                        </button>
                    </form>
                </div>

                <div>
                    @foreach ($notes as $note)
                        <article class="note" data-note-id="{{ $note->id }}">
                            <label>
                                <input type="checkbox" name="note_ids[]" value="{{ $note->id }}" class="note-checkbox">
                                <h3 class="note-title">{{ $note->title }}</h3>
                                <p class="note-content">{{ $note->content }}</p>
                            </label>
                            <hr>
                        </article>
                    @endforeach
                </div>

                @if(session('warning'))
                    <div class="alert alert-warning">{{ session('warning') }}</div>
                @endif
            </section>
        @endif

        <script>
            const checkboxes = document.querySelectorAll('.note-checkbox');
            const deleteButton = document.getElementById('delete-selected-button');
            const deleteForm = document.getElementById('delete-selected-form');
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

            deleteButton.addEventListener('click', () => {
                deleteForm.submit(); 
            });

        </script>
    </div>
</body>
</html>
