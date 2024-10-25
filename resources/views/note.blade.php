<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notes</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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
            <li><a href="{{ route('showTrash') }}" class="nav-link">Trash Bin</a></li>
        </ul>
    </nav>

    <div class="container">
        <header class="logo">
            <a href="{{ route('showAll') }}">
                <img src="{{ asset('images/datadump.png') }}" alt="Data Dump Logo" class="logo-img">
            </a>
        </header>

        <a href="{{ url()->previous() }}" class="home-button" aria-label="Go back"><i class="fa-solid fa-circle-left"></i></a>

        <main>
            <h1>My Note</h1>
            <article class="note">
                <div class="note-timestamps" style="font-size: 0.8em; color: gray;">
                    <div>Updated: {{ $note->updated_at->setTimezone('Asia/Manila')->format('F j, Y  [ g:i a ] ') }}</div>
                </div>
                <h2 class="note-title">{{ $note->title }}</h2>
                <p class="note-content-view">{{ $note->content }}</p>
                <div class="bookmark-container">
                    <form action="{{ route('toggleBookmark', ['id' => $note->id]) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn" style="font-family: 'Courier New', Courier, monospace;">
                            @if ($note->is_bookmarked)
                                <i class="fa-solid fa-bookmark"></i>
                            @else
                                <i class="fa-regular fa-bookmark"></i>
                            @endif
                        </button>
                    </form>
                </div>
                <div class="button-group">
                    <form action="{{ route('editNote', ['id' => $note->id]) }}" method="GET">
                        <button type="submit" class="btn"><i class="fa-regular fa-pen-to-square"></i></button>
                    </form>

                    <form action="{{ route('deleteNote', ['id' => $note->id]) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                        @method("DELETE")
                        @csrf 
                        <button type="submit" class="btn"><i class="fa-solid fa-trash"></i></button>
                    </form>
                </div>
            </article>
        </main>
    </div>

</body>
</html>
