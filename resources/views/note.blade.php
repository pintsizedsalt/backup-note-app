<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notes</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
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
        </div>
        <ul>
        <li><a href="{{ route('showAll') }}" class="nav-link">My Notes</a></li>
            <li><a href="{{ route('showBookmarkedNotes') }}" class="nav-link">Bookmarks</a></li>
            <li><a href="{{ route('showTrash') }}" class="nav-link">Trash Bin</a></li>

        </ul>
    </nav>

    <div class="container">
            <div class="logo">
                <a href="{{ route('showAll') }}">
                    <img src="{{ asset('images/datadump.png') }}" alt="datadump" class="logo-img">
                </a>
            </div>
        <h1>MY NOTE</h1>
        <div class="note">
        <div class="note-timestamps" style="font-size: 0.8em; color: gray;">
            <div>updated : {{ $note->updated_at->setTimezone('Asia/Manila')->format('F j, Y  [ g:i a ] ') }}</div>
            </div>
            <div class="note-title">{{$note->title}}</div>
            <div class="note-content-view">{{ $note->content }}</div>
            <div class="button-group">
           
            <form action="{{ route('toggleBookmark', ['id' => $note->id]) }}" method="POST">
                @csrf
                <button type="submit" class="btn" style="font-family: 'Courier New', Courier, monospace;">
                <i class="fas fa-bookmark"></i> 
                    {{ $note->is_bookmarked ? 'Unbookmark' : 'Bookmark' }}
                </button>
            </form>

                <form action="{{route('deleteNote', ['id' => $note->id])}}" method="POST" onsubmit="return confirm('Are you sure?')">
                    @method("DELETE")
                    @csrf 
                    <button type="submit" class="btn"><i class="fa-solid fa-trash"></i></button>
                </form>
                
                <form action="{{ route('editNote', ['id' => $note->id]) }}" method="GET">
                    <button type="submit" class="btn"><i class="fa-regular fa-pen-to-square"></i></button>
                </form>
                
                <a href="{{ route('showAll') }}" class="btn "><i class="fa-solid fa-house"></i></a>

            </div>
        </div>
    </div>
</body>
</html>
