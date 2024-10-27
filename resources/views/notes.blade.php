<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DataDump</title>
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
            <li><a href="{{ route('showAll') }}" class="nav-link.active nav" id="bold"><svg id="iconn" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#000000"><path d="M320-240h320v-80H320v80Zm0-160h320v-80H320v80ZM240-80q-33 0-56.5-23.5T160-160v-640q0-33 23.5-56.5T240-880h320l240 240v480q0 33-23.5 56.5T720-80H240Zm280-520v-200H240v640h480v-440H520ZM240-800v200-200 640-640Z"/></svg> My Notes</a></li>
            <li>
                <a href="{{ route('showBookmarkedNotes') }}" class="nav-link" id="bold">
                    <svg id="iconn" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#000000">
                        <path d="m389-400 91-55 91 55-24-104 80-69-105-9-42-98-42 98-105 9 80 69-24 104ZM200-120v-640q0-33 23.5-56.5T280-840h400q33 0 56.5 23.5T760-760v640L480-240 200-120Zm80-122 200-86 200 86v-518H280v518Zm0-518h400-400Z"/>
                    </svg>
                    Bookmarks
                </a>
            </li>
            <li><a href="{{ route('showTrash') }}" class="nav-link" id="bold"><svg id="iconn" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#000000"><path d="M280-120q-33 0-56.5-23.5T200-200v-520h-40v-80h200v-40h240v40h200v80h-40v520q0 33-23.5 56.5T680-120H280Zm400-600H280v520h400v-520ZM360-280h80v-360h-80v360Zm160 0h80v-360h-80v360ZM280-720v520-520Z"/></svg>Trash Bin</a></li>
        </ul>
    </nav>
    
    <main class="container section1 ">
        <header class="logo">
    
                <a href="{{ route('showAll') }}">
                    <img src="{{ asset('images/datadump.png') }}" alt="DataDump Logo" class="logo-img">
                </a>
                <h1>My Notes</h1>
        
        </header>

        <section class="create-note-wrapper">
            @if(empty($search))
            <form action="{{ route('createNote') }}" method="GET" class="create-note-form">
                <button type="submit">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#000000">
                        <path d="M440-440H200v-80h240v-240h80v240h240v80H520v240h-80v-240Z"/>
                    </svg>
                    <span class="create-text">Create</span>
                </button>
            </form>
            @endif
        </section>


        <section class="search-section">
            <form action="" method="GET" class="search-form">
                <label class="search-label">
                    <input type="search" name="search" id="search" placeholder="Search..." value="{{ $search }}" required class="input-title search-input">
                    <kbd class="slash-icon">/</kbd>
                    <svg class="search-icon" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#000000"><path d="M784-120 532-372q-30 24-69 38t-83 14q-109 0-184.5-75.5T120-580q0-109 75.5-184.5T380-840q109 0 184.5 75.5T640-580q0 44-14 83t-38 69l252 252-56 56ZM380-400q75 0 127.5-52.5T560-580q0-75-52.5-127.5T380-760q-75 0-127.5 52.5T200-580q0 75 52.5 127.5T380-400Z"/></svg>
                </label>
                @if(!empty($search))
                    <a href="{{ route('showAll') }}" class="home-button" aria-label="Go back"><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#000000"><path d="M760-200v-160q0-50-35-85t-85-35H273l144 144-57 56-240-240 240-240 57 56-144 144h367q83 0 141.5 58.5T840-360v160h-80Z"/></svg></a>
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
        @if(!$notes->isEmpty())
        <section class="notes-list">
            @foreach ($notes as $note)
                <a href="{{ route('showNote', ['id' => $note->id]) }}" class="card" style="text-decoration: none; color: inherit;"> 
                    <div class="text">
                    <div class="note-timestamps" style="font-size: 10px; color: gray;">
                    <time datetime="{{ $note->created_at }}">{{ $note->created_at->setTimezone('Asia/Manila')->format('F j, Y  [ g:i a ]') }}</time>
                    </div>
                        <span>{{ $note->title }}</span>
                        <p class="subtitle">{{ Str::limit($note->description, 60, '...') }}</p>
                        <p class="subtitle">{{ Str::limit($note->content, 30, '...') }}</p>
                    </div>
                </a>
            @endforeach
        </section>
        @endif

        <script>
            document.addEventListener('keydown', function(event) {
                if (event.key === '/') {
                    event.preventDefault(); 
                    document.getElementById('search').focus(); 
                }
            });
        </script>
    </main>
</body>
        <footer class="main-footer">
            <p>© {{ date('Y') }} DataDump | BSIS 2 1st Sem Midterm Project | All Rights Reserved</p>
            <p>Developed by Shandi and Salt</p>
        </footer>
</html>
