<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookmarked Notes</title>
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
        <li><a href="{{ route('showAll') }}" class="nav-link"><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#000000"><path d="M320-240h320v-80H320v80Zm0-160h320v-80H320v80ZM240-80q-33 0-56.5-23.5T160-160v-640q0-33 23.5-56.5T240-880h320l240 240v480q0 33-23.5 56.5T720-80H240Zm280-520v-200H240v640h480v-440H520ZM240-800v200-200 640-640Z"/></svg>My Notes</a></li>
        <li>
            <a href="{{ route('showBookmarkedNotes') }}" class="nav-link">
                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#000000">
                    <path d="m389-400 91-55 91 55-24-104 80-69-105-9-42-98-42 98-105 9 80 69-24 104ZM200-120v-640q0-33 23.5-56.5T280-840h400q33 0 56.5 23.5T760-760v640L480-240 200-120Zm80-122 200-86 200 86v-518H280v518Zm0-518h400-400Z"/>
                </svg>
                Bookmarks
            </a>
        </li>
        <li><a href="{{ route('showTrash') }}" class="nav-link"><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#000000"><path d="M280-120q-33 0-56.5-23.5T200-200v-520h-40v-80h200v-40h240v40h200v80h-40v520q0 33-23.5 56.5T680-120H280Zm400-600H280v520h400v-520ZM360-280h80v-360h-80v360Zm160 0h80v-360h-80v360ZM280-720v520-520Z"/></svg>Trash Bin</a></li>
    </ul>
</nav>

<main class="container">
    <header class="logo">
        <a href="{{ route('showAll') }}">
            <img src="{{ asset('images/datadump.png') }}" alt="DataDump Logo" class="logo-img">
        </a>
        <h1>Bookmarks</h1>
    </header>

    <section class="search-section">
        <form action="{{ route('showBookmarkedNotes') }}" method="GET" class="search-form">
            <label class="search-label">
                <input type="search" name="search" id="search" placeholder="Search..." value="{{ $search }}" required class="input-title search-input">
                <kbd class="slash-icon">/</kbd>
                <svg class="search-icon" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="512" height="512" x="0" y="0" viewBox="0 0 56.966 56.966" style="enable-background:new 0 0 512 512" xml:space="preserve">
                    <g>
                        <path d="M55.146 51.887 41.588 37.786A22.926 22.926 0 0 0 46.984 23c0-12.682-10.318-23-23-23s-23 10.318-23 23 10.318 23 23 23c4.761 0 9.298-1.436 13.177-4.162l13.661 14.208c.571.593 1.339.92 2.162.92.779 0 1.518-.297 2.079-.837a3.004 3.004 0 0 0 .083-4.242zM23.984 6c9.374 0 17 7.626 17 17s-7.626 17-17 17-17-7.626-17-17 7.626-17 17-17z" fill="currentColor" data-original="#000000" class=""></path>
                    </g>
                </svg>
            </label>
            @if(!empty($search))
                <a href="{{ route('showBookmarkedNotes') }}" class="home-button"><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#000000"><path d="M760-200v-160q0-50-35-85t-85-35H273l144 144-57 56-240-240 240-240 57 56-144 144h367q83 0 141.5 58.5T840-360v160h-80Z"/></svg></a>
            @endif
        </form>
    </section>

    @if($notes->isEmpty() && !empty($search))
        <section class="no-notes">
            <p>No notes found. Try a different search! ✨</p>
        </section>
    @elseif ($noNotesMessage)
        <section class="no-notes-message">
            <h2>{{ $noNotesMessage }}</h2>
            <p>It looks like you haven't bookmarked any notes yet. Start exploring your notes and bookmark your favorites!</p>
            <a href="{{ route('showAll') }}" id="button" style="text-decoration: none;">Go to My Notes</a>
        </section>
    @else
        <section class="notes-list">
            @foreach ($notes as $note)
                <a href="{{ route('showNote', ['id' => $note->id]) }}" class="card" style="text-decoration: none; color: inherit;"> 
                    <div class="text">
                    <div class="note-timestamps" style="font-size: 10px; color: gray;">
                    <time datetime="{{ $note->created_at }}">{{ $note->created_at->setTimezone('Asia/Manila')->format('F j, Y  [ g:i a ]') }}</time>
                    </div>
                        <span>{{ $note->title }}</span>
                        <p class="subtitle">{{ Str::limit($note->description, 100, '...') }}</p>
                        <p class="subtitle">{{ Str::limit($note->content, 100, '...') }}</p>
                    </div>
                </a>
            @endforeach
        </section>
    @endif

</main>
</body>
</html>
