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
<<<<<<< HEAD
<div class="container">
    <h1>MY NOTES</h1>
    <div class="note">
        <div class="note-title">{{$note->title}}</div>
        <div class="note-content">{{$note->content}}</div>
        <div class="button-group">
            <form action="{{route('deleteNote', ['id' => $note->id])}}" method="POST" onsubmit="return confirm('Are you sure?')">
                @method("DELETE")
                @csrf 
                <button type="submit" class="btn">Delete</button>
            </form>
            <form action="{{ route('editNote', ['id' => $note->id]) }}" method="GET">
                <button type="submit" class="btn">Edit</button>
            </form>
            <form action="{{ route('showAll') }}" method="GET">
                <button type="submit" class="btn">Cancel</button>
            </form>
        </div>
    </div>
</div>
=======
<h1>MY NOTE</h1>

    <div>Title: {{$note->title}}</div>
    <div>Description: {{$note->description}}</div>
    <div>Content: {{$note->content}}</div>
    
    <br>

    <form action="{{route('deleteNote', ['id' => $note->id])}}" method="POST"
    onsubmit="return confirm('are you sure?')">
    @method("DELETE")
    @csrf 
    <button type="submit">Delete</button>

    </form>

    <form action="{{ route('editNote', ['id' => $note->id]) }}" method="GET">
        <button type="submit">
            Edit User</button>

    </form>

    <form action="{{ route('showAll') }}" method="GET">
        <button type="submit">Back to Notes</button>
    </form>
>>>>>>> 38fdfe8373bcf8853b9644a837d68613e1584da3

</div>
</body>
</html>
