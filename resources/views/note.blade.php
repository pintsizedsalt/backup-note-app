<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Note</title>
</head>
<body>
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

</body>
</html>