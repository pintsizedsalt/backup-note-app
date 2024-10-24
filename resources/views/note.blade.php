<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notes</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Fira+Code:wght@400;500;600&display=swap">
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
        </div>
        <ul>
            <li><a href="{{ route('showBookmarkedNotes') }}" class="nav-link">Bookmarks</a></li>
            <li><a href="{{ route('showAll') }}" class="nav-link">My Notes</a></li>
        </ul>
    </nav>

    <div class="container">
        <h1>MY NOTES</h1>
        <div class="note">
            <div class="note-title">{{$note->title}}</div>
            <div class="note-content">{{ $note->content }}</div>
            <div class="button-group">
                <form action="{{ route('toggleBookmark', ['id' => $note->id]) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn">
                        {{ $note->is_bookmarked ? 'Unbookmark' : 'Bookmark' }}
                    </button>
                </form>

                <form action="{{route('deleteNote', ['id' => $note->id])}}" method="POST" onsubmit="return confirm('Are you sure?')">
                    @method("DELETE")
                    @csrf 
                    <button type="submit" class="btn">Delete</button>
                </form>
                <form action="{{ route('editNote', ['id' => $note->id]) }}" method="GET">
                    <button type="submit" class="btn">Edit</button>
                </form>
                <form action="{{ route('showAll') }}" method="GET">
                    <button type="submit" class="btn">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
