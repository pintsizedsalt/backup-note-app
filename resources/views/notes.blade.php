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
        <ul>
            <li><a href="{{ route('showAll') }}" class="nav-link active">My Notes</a></li>
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

        <h1>MY NOTES</h1>

        <div class="row m-2">
            <form action="" method="GET">
                <div class="form-group">
                    <input type="search" name="search" id="title" placeholder="search..." value="{{ $search }}" required class="input-title" style="margin-right: 2px;">
                </div>
                <div class="button-group" >
                    <button class="btn btn-primary" type="submit" style="font-family: 'Courier New', Courier, monospace;"> <i class="fa-solid fa-magnifying-glass"></i> search </button>
                    @if(!empty($search))
                        <a href="{{ url('/notes') }}">
                            <button class="btn btn-primary" type="button"> <i class="fa-solid fa-house"></i> Back </button>
                        </a>
                    @endif
                </div>
            </form>
        </div>

        @if($notes->isEmpty())
            <div class="no-notes">
                <p>No notes yet, but that's okay! ✨ Start jotting down your thoughts and let your ideas bloom! 🌼💖</p>
            </div>
        @endif

        <div class="create-note-wrapper">
            <form action="{{ route('createNote') }}" method="GET" class="create-note-form">
                <button type="submit" class="btn" style="font-family: 'Courier New', Courier, monospace;"><i class="fa-solid fa-plus"></i> create</button>
            </form>
        </div>

        @if(!$notes->isEmpty())
            @foreach ($notes as $note)
                <div class="note">
                <div class="note-timestamps" style="font-size: 0.8em; color: gray;">
                    <div> {{ $note->created_at->setTimezone('Asia/Manila')->format('F j, Y  [ g:i a ] ') }} </div>
               
                </div>
                
                    <a href="{{ route('showNote', ['id' => $note->id]) }}" style="text-decoration: none; color: inherit;">
                        <div style="font-weight: bold; font-size: 20px;">{{$note->title}}</div>
                        <div class="note-content">{{ Str::limit($note->content, 100, '...') }}</div>
                    </a>
                
                    <hr>
                    
                </div>
            @endforeach
        @endif
    </div>
</body>
</html>
