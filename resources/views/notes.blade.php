<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notes</title>
</head>

<body>
    <h1>MY NOTES</h1>

    <div>
        <div class="row m-2">
            <form action="">
              <div>
                <input type="search" name="search" id="title" placeholder="search" value="{{$search}}">
                <button class="btn btn-primary"> search here </button>
                <a href="{{url('/notes')}}">
                <button class="btn btn-primary" type="button"> reset  </button>
                </a>
              </div>
            </form>
        </div>

      
    </div>
  




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