<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trash Bin</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="icon" href="{{ asset('images/datadump.png') }}" type="image/png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
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
            <li><a href="{{ route('showAll') }}" class="nav-link" id="bold"><svg id="iconn" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#000000"><path d="M320-240h320v-80H320v80Zm0-160h320v-80H320v80ZM240-80q-33 0-56.5-23.5T160-160v-640q0-33 23.5-56.5T240-880h320l240 240v480q0 33-23.5 56.5T720-80H240Zm280-520v-200H240v640h480v-440H520ZM240-800v200-200 640-640Z"/></svg> My Notes</a></li>
            <li>
                <a href="{{ route('showBookmarkedNotes') }}" class="nav-link" id="bold">
                    <svg id="iconn" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#000000">
                        <path d="m389-400 91-55 91 55-24-104 80-69-105-9-42-98-42 98-105 9 80 69-24 104ZM200-120v-640q0-33 23.5-56.5T280-840h400q33 0 56.5 23.5T760-760v640L480-240 200-120Zm80-122 200-86 200 86v-518H280v518Zm0-518h400-400Z"/>
                    </svg>
                    Bookmarks
                </a>
            </li>
            <li><a href="{{ route('showTrash') }}" class="nav-link.active nav" id="bold"><svg id="iconn" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#000000"><path d="M280-120q-33 0-56.5-23.5T200-200v-520h-40v-80h200v-40h240v40h200v80h-40v520q0 33-23.5 56.5T680-120H280Zm400-600H280v520h400v-520ZM360-280h80v-360h-80v360Zm160 0h80v-360h-80v360ZM280-720v520-520Z"/></svg>Trash Bin</a></li>
        </ul>
    </nav>
 
    <div class="container">
        <header class="logo">
            <a href="{{ route('showAll') }}">
                <img src="{{ asset('images/datadump.png') }}" alt="Data Dump Logo" class="logo-img">
            </a>
            <h1>Trash Bin</h1>
        </header>        
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @elseif(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        @if ($notes->isEmpty())
            <section class="no-notes-message">
                <h2>Your Trash Bin is Empty</h2>
                <p>It looks like there are no notes in your trash. When you delete notes, they'll appear here for you to restore or permanently delete.</p>
                <a href="{{ route('showAll') }}" id="button" style="text-decoration: none;"> Go to My Notes</a>
            </section>
        @else
            <main class="trash-notes">
                <section>
                <div class="button-group-trash" style="display: flex; gap: 10px; align-items: center;">

                    <button id="select-all-button" type="button">Select All</button>

                    <form action="{{ route('emptyTrash') }}" method="POST" onsubmit="return confirm('Are you sure you want to empty your trash bin? This will be permanently deleted.')" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Empty Trash</button>
                    </form>

                    <form action="{{ route('deleteSelectedNotes') }}" method="POST" id="delete-selected-form" onsubmit="return confirm('Are you sure you want to delete this? This will be permanently deleted.')" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" id="delete-selected-button" style="display: none;">Delete Forever</button>
                    </form>

                    <form action="{{ route('restoreSelectedNotes') }}" method="POST" id="restore-selected-form" style="display: inline;">
                        @csrf
                        <div id="restore-notes-container"></div>
                        <button type="submit" id="restore-selected-button" style="display: none;">Restore</button>
                    </form>
                </div>

                </section>
                
                <section class="notes-list">
                    @foreach ($notes as $note)
                        <article class="note card" data-note-id="{{ $note->id }}">
                            <label class="custom-checkbox">
                                <input type="checkbox" class="note-checkbox" name="note_ids[]" value="{{ $note->id }}">
                                <span class="checkmark"></span>
                            </label>
                                <div class="text">
                                    <div class="note-timestamps" style="font-size: 10px; color: gray;">
                                        <time datetime="{{ $note->created_at }}">{{ $note->created_at->setTimezone('Asia/Manila')->format('F j, Y  [ g:i a ]') }}</time>
                                    </div>
                                    <span>{{ $note->title }}</span>
                                    <p class="subtitle">{{ Str::limit($note->description, 100, '...') }}</p>
                                    <p class="subtitle">{{ Str::limit($note->content, 200, '...') }}</p>
                                </div>
                            <hr>
                        </article>
                    @endforeach
                </section>

                @if(session('warning'))
                    <div class="alert alert-warning">{{ session('warning') }}</div>
                @endif
            </main>
        @endif

        <script>
            const checkboxes = document.querySelectorAll('.note-checkbox');
            const deleteButton = document.getElementById('delete-selected-button');
            const deleteForm = document.getElementById('delete-selected-form');
            const restoreButton = document.getElementById('restore-selected-button');
            const restoreContainer = document.getElementById('restore-notes-container');
            const selectAllButton = document.getElementById('select-all-button');

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

            document.querySelectorAll('.note').forEach(note => {
                note.addEventListener('click', () => {
                    const checkbox = note.querySelector('.note-checkbox');
                    checkbox.checked = !checkbox.checked; 
                    checkbox.dispatchEvent(new Event('change')); 
                });
            });

            document.addEventListener('DOMContentLoaded', () => {
                const alerts = document.querySelectorAll('.alert');
                alerts.forEach(alert => {
                    setTimeout(() => {
                        alert.classList.add('fade-out');
                        alert.addEventListener('transitionend', () => {
                            alert.remove();
                        });
                    }, 800);
                });
            });


            deleteButton.addEventListener('click', () => {
                const selectedNotes = Array.from(checkboxes)
                    .filter(cb => cb.checked)
                    .map(cb => cb.value);

                if (selectedNotes.length > 0) {
                    selectedNotes.forEach(id => {
                        const input = document.createElement('input');
                        input.type = 'hidden';
                        input.name = 'note_ids[]';
                        input.value = id;
                        deleteForm.appendChild(input);
                    });
                    deleteForm.submit();
                } else {
                    alert("Please select at least one note to delete.");
                }
            });

            selectAllButton.addEventListener('click', () => {
                const allChecked = Array.from(checkboxes).every(cb => cb.checked);
                checkboxes.forEach(cb => {
                    cb.checked = !allChecked; 
                    cb.dispatchEvent(new Event('change')); 
                });
                deleteButton.style.display = !allChecked ? 'block' : 'none';
                restoreButton.style.display = !allChecked ? 'block' : 'none';
            });

        </script>

    </div>
</body>

        <footer class="main-footer">
            <p>© {{ date('Y') }} DataDump | BSIS 2 1st Sem Midterm Project | All Rights Reserved</p>
            <p>Developed by Shandi and Salt</p>
        </footer>
</html>
