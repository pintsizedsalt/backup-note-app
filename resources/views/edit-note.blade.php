<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Note</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Fira+Code:wght@400;500;600&display=swap">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
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
                <li><a href="{{ route('showBookmarkedNotes') }}" class="nav-link active">Bookmarks</a></li>
                <li><a href="{{ route('showAll') }}" class="nav-link">My Notes</a></li>
            </ul>
        </nav>
    <div class="container">
        <h1>Edit Note</h1>
        <form action="{{ route('updateNote', ['id' => $note->id])}}" method="POST"> 
            @method("PUT")
            @csrf 
            <div class="form-group">
                <label for="title">Title</label>
                <input value="{{$note->title}}" type="text" id="title" name="title" required class="input-title">
            </div>
            <div class="form-group">
                <label for="content">Content</label>
                <textarea id="content" name="content" rows="5" required style="width: 100%;">{{$note->content}}</textarea>
            </div>

            <button type="submit" class="btn">Save</button>

            <form action="{{ route('showAll') }}" method="GET" style="margin-top: 15px;">
            <button type="submit" class="btn">Cancel</button>
        </form>
    </div>
</body>
</html>
