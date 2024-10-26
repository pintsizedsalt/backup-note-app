<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Note</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .input-title {
            width: 300px;
            max-width: 100%;
        }
        .form-group {
            margin-bottom: 15px; 
        }
    </style>
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
        <header class="logo">
            <a href="{{ route('showAll') }}">
                <img src="{{ asset('images/datadump.png') }}" alt="Data Dump Logo" class="logo-img">
            </a>

        <a href="{{ url()->previous() }}" class="home-button" aria-label="Go back"><i class="fa-solid fa-circle-left"></i></a>
        
        <h1>Edit Note</h1>

        </header>
        <main>
            
            <form action="{{ route('updateNote', ['id' => $note->id])}}" method="POST"> 
                @method("PUT")
                @csrf 
                <div class="form-group">
                    <label for="title">Title</label>
                    <input value="{{$note->title}}" type="text" id="title" name="title" required class="input-title">
                </div>

                <div class="form-group">
                    <label for="description">Description:</label>
                    <textarea name="description" id="description" rows="1" class="input-description" required>{{ $note->description }}</textarea>
                </div>

                <div class="form-group"> 
                    <label for="content">Content</label>
                    <textarea id="content" name="content" rows="6" required></textarea>
                </div>

                <button type="submit" class="btn-homepage" style="font-family: 'Courier New', Courier, monospace;">
                    Save <i class="fa-solid fa-floppy-disk"></i>
                </button>
            </form>
        </main>
    </div>
</body>
</html>
