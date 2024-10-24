<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookmarked Notes</title>
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
            <li><a href="{{ route('showBookmarkedNotes') }}" class="nav-link active">Bookmarks</a></li>
            <li><a href="{{ route('showTrash') }}" class="nav-link">Trash Bin</a></li>
        </ul>
    </nav>

    <div class="container">
        <h1>Bookmarks</h1>

        @if ($notes->isEmpty())
            <div class="no-notes-message">
                <h2>No Bookmarked Notes Found</h2>
                <p>It looks like you haven't bookmarked any notes yet. Start exploring your notes and bookmark your favorites!</p>
                <a href="{{ route('showAll') }}" class="btn">Go to My Notes</a>
            </div>
        @else
            @foreach ($notes as $note)
                <div class="note">
                    <a href="{{ route('showNote', ['id' => $note->id]) }}" style="text-decoration: none; color: inherit;">
                        <div style="font-weight: bold; font-size: 20px;">{{ $note->title }}</div>
                        <div class="note-content">{{ $note->content }}</div>
                    </a>
                    <hr>
                </div>
            @endforeach
        @endif
    </div>
</body>
</html>
