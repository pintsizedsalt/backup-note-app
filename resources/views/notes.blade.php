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
            <li><a href="{{ route('showAll') }}" class="nav-link active">My Notes</a></li>
            <li><a href="{{ route('showBookmarkedNotes') }}" class="nav-link">Bookmarks</a></li>
            <li><a href="{{ route('showTrash') }}" class="nav-link">Trash Bin</a></li>
        </ul>
    </nav>
    
    <main class="container">
        <div class="logo">
            <a href="{{ route('showAll') }}">
                <img src="{{ asset('images/datadump.png') }}" alt="DataDump Logo" class="logo-img">
            </a>
        </div>

        <h1>My Notes</h1>

        <section class="search-section">
            <form action="" method="GET" class="search-form">
                <div class="form-group-2">
                    <input type="search" name="search" id="search" placeholder="Search..." value="{{ $search }}" required class="input-title search-input">
                    <button class="search-button btn-primary" type="submit">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </div>
                @if(!empty($search))
                    <a href="{{ route('showAll') }}" class="home-button" aria-label="Go back"><i class="fa-solid fa-circle-left"></i></a>
                @endif
            </form>
        </section>

        @if($notes->isEmpty() && !empty($search))
            <section class="no-notes">
                <p>No notes found. Try a different search! ✨</p>
            </section>
        @elseif($notes->isEmpty())
            <section class="no-notes">
                <p>No notes yet, but that's okay! ✨ Start jotting down your thoughts and let your ideas bloom! 🌼💖</p>
            </section>
        @endif

        @if(empty($search))
            <section class="create-note-wrapper">
                <form action="{{ route('createNote') }}" method="GET" class="create-note-form">
                    <button type="submit" class="btn-homepage" style="font-family: 'Courier New', Courier, monospace;">
                        <i class="fa-solid fa-plus"></i> Create
                    </button>
                </form>
            </section>
        @endif

        @if(!$notes->isEmpty())
            <section class="notes-list">
                @foreach ($notes as $note)
                    <article class="note">
                        <div class="note-timestamps" style="font-size: 0.8em; color: gray;">
                            <time datetime="{{ $note->created_at }}">{{ $note->created_at->setTimezone('Asia/Manila')->format('F j, Y  [ g:i a ]') }}</time>
                        </div>
                        
                        <a href="{{ route('showNote', ['id' => $note->id]) }}" style="text-decoration: none; color: inherit;">
                            <h2 style="font-weight: bold; font-size: 20px;">{{ $note->title }}</h2>
                            <p class="note-content">{{ Str::limit($note->content, 100, '...') }}</p>
                        </a>
                        
                        <hr>
                    </article>
                @endforeach
            </section>
        @endif
    </main>
</body>
</html>
