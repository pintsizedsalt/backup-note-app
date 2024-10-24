<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notes</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
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
            <li><a href="{{ route('showAll') }}" class="nav-link active">My Notes</a></li>
            <li><a href="{{ route('showBookmarkedNotes') }}" class="nav-link">Bookmarks</a></li>
            <li><a href="{{ route('showTrash') }}" class="nav-link">Trash Bin</a></li>
        </ul>
    </nav>
    
    <div class="container">
    <h1>MY NOTES</h1>

    <div class="row m-2">
        <form action="" method="GET">
            <div class="form-group">
                <input type="search" name="search" id="title" placeholder="search..." value="{{ $search }}" required class="input-title" style="margin-right: 2px;">
            </div>
            <div class="button-group">
                <button class="btn btn-primary" type="submit">Search</button>
                @if(!empty($search))
                    <a href="{{ url('/notes') }}">
                        <button class="btn btn-primary" type="button">Back</button>
                    </a>
                @endif
            </div>
        </form>
    </div>

    <form action="{{ route('createNote') }}" method="GET" class="create-note-form">
        <button type="submit" class="btn">Create New Note</button>
    </form>

    @if($noNotesMessage)
        <div class="no-notes-message">{{ $noNotesMessage }}</div>
    @endif

    @foreach ($notes as $note)
        <div class="note">
            <a href="{{ route('showNote', ['id' => $note->id]) }}" style="text-decoration: none; color: inherit;">
                <div style="font-weight: bold; font-size: 20px;">{{$note->title}}</div>
                <div class="note-content">{{ Str::limit($note->content, 100, '...') }}</div>
            </a>
            <hr>
        </div>
    @endforeach
</div>


</body>
</html>
