<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/modern-css-reset/dist/reset.min.css">
    <link rel="stylesheet" href="{{ asset('css/style_edit.css') }}">
    <script src="https://kit.fontawesome.com/b92e2df7a0.js" crossorigin="anonymous"></script>
    <!-- <link rel="icon" type="image/png" href="/path/to/favicon.png"> -->
    <!-- public内にfaviconデータ置く -->
    <title>Edit</title>
</head>

<body>
    <header class="header"></header>

    <main class="todo_list">
        <h1>TO DO EDIT</h1>

        <div class="wrapper">
            <form action="/tasks/{{ $task->id }}" method="post">
                @csrf
                @method('PUT')
                    <label>
                        <input type="text" name="task_name" value="{{ $task->name }}">
                        @error('task_name')
                        <div class="contents">
                            <p>{{ $message }}</p>
                        </div>
                        @enderror
                    </label>

                <div class="buttons">
                    <ul>
                        <li>
                            <button type="submit" class="back"><a href="/tasks"><i class="fa-solid fa-reply"></i></a></button>
                        </li>
                        <li>
                            <button type="submit" class="edit"><i class="fa-solid fa-pen"></i></button>
                        </li>
                    </ul>
                </div>
            </form>
        </div>
    </main>
    
    <footer class="footer">
        To do App
    </footer>
</body>

</html>
