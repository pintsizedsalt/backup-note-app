<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookmarked Notes</title>
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
            <li><a href="{{ route('showBookmarkedNotes') }}" class="nav-link active">Bookmarks</a></li>
            <li><a href="{{ route('showTrash') }}" class="nav-link">Trash Bin</a></li>
        </ul>
    </nav>

    <main class="container">
        <div class="logo">
            <a href="{{ route('showAll') }}">
                <img src="{{ asset('images/datadump.png') }}" alt="DataDump Logo" class="logo-img">
            </a>
        </div>
        
        <h1>Bookmarks</h1>

        <section class="search-section">
            <form action="{{ route('showBookmarkedNotes') }}" method="GET" class="search-form">
                <div class="form-group-2">
                    <input type="search" name="search" id="search" placeholder="Search..." value="{{ $search }}" required class="input-title search-input">
                    <button class="search-button btn-primary" type="submit">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </div>
                @if(!empty($search))
                    <a href="{{ route('showBookmarkedNotes') }}" class="home-button"><i class="fa-solid fa-circle-left"></i></a>
                @endif
            </form>
        </section>

        @if ($noNotesMessage)
            <section class="no-notes-message">
                <h2>{{ $noNotesMessage }}</h2>
                <p>It looks like you haven't bookmarked any notes yet. Start exploring your notes and bookmark your favorites!</p>
                <a href="{{ route('showAll') }}" class="btn-homepage">Go to My Notes</a>
            </section>
        @else
            <section class="notes-list">
                @foreach ($notes as $note)
                    <article class="note">
                        <a href="{{ route('showNote', ['id' => $note->id]) }}" style="text-decoration: none; color: inherit;">
                            <h3 style="font-weight: bold; font-size: 20px;">{{ $note->title }}</h3>
                            <p class="note-content">{{ $note->content }}</p>
                        </a>
                        <hr>
                    </article>
                @endforeach
            </section>
        @endif

    </main>
</body>
</html>
