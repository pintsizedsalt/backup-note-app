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
    <div class="container">
        <h1>MY NOTES</h1>

        <div class="hamburger-menu">
            <input type="checkbox" id="menu-toggle" style="display: none;"> <!-- Hide the checkbox -->
            <label for="menu-toggle" class="hamburger-icon">&#9776;</label>
            <div class="menu-content">
                <a href="{{ route('showAll') }}">My Notes</a>
                <a href="{{ route('showBookmarkedNotes') }}">Bookmarked Notes</a> <!-- Added this link -->
            </div>
        </div>

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

        @foreach ($notes as $note)
            <div class="note">
                <a href="{{ route('showNote', ['id' => $note->id]) }}" style="text-decoration: none; color: inherit;">
                    <div style="font-weight: bold; font-size: 20px;">{{$note->title}}</div>
                    <div class="note-content">{{ $note->content }}</div>
                </a>
                <hr>
            </div>
        @endforeach
        
        <form action="{{ route('createNote') }}" method="GET" class="create-note-form">
            <button type="submit" class="btn">Create New Note</button>
        </form>
    </div>
</body>
</html>