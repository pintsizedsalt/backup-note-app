<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notes</title>
</head>

<body>
    <h1>HELLO</h1>

    <form action="{{ route('createNote') }}" method="GET">
        @method('GET')
        <button type="submit">Create New Note</button>
    </form>

    @foreach ($notes as $note)
        <div>Title: {{$note->title}}</div>
        <div>Description: {{$note->description}}</div>
        <div>Content: {{$note->content}}</div>

        <form action="{{ route('showNote', ['id' => $note->id]) }}" method="GET">
        <button type="submit">
            View Note</button>
    </form>

        <hr>
    @endforeach
</body>
</html>