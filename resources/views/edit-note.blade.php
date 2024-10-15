<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit</title>
</head>
<body>
    <h1>Edit Note</h1>

    <form action="{{ route('updateNote', ['id' => $note->id])}}" method="POST"> 
        @method("PUT")
        @csrf 
        <label for="title">Title</label>
        <input value="{{$note->title}}" type="text" id="title" name="title" required>
        <br>
        <label for="description">Description</label>
        <input value="{{$note->description}}" type="text" id="description" name="description" required>
        <br>
        <label for="content">Content</label>
        <input value="{{$note->content}}" type="text" id="content" name="content" required>
        <br>
    

        <button type="submit"> Update Note</button>

    </form>

</body>
</html>