<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/modern-css-reset/dist/reset.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script src="https://kit.fontawesome.com/b92e2df7a0.js" crossorigin="anonymous"></script>
    <!-- <link rel="icon" type="image/png" href="/path/to/favicon.png"> -->
    <!-- public内にfaviconデータ置く -->
    <title>Todo</title>
</head>

<body>
    <header class="header"></header>

    <main class="todo_list">
        <h1>TO DO</h1>
        <form action="/tasks" method="POST">
            @csrf
            <div class="task">
                <label>
                    <input type="text" name="task_name" placeholder="Tell me your task">
                    @error('task_name')
                    <div class="error_message">
                        <p>{{ $message }}</p>
                    </div>
                    @enderror
                </label>
                <button type="submit" class="add"><i class="fa-solid fa-plus"></i></button>
            </div>
        </form>

        @if($tasks->isNotEmpty())
        <div class="wrapper">
        @foreach($tasks as $item)
                <div class="contents">
                    <p>{{ $item->name }}</p>
                </div>
                <div class="buttons">
                    <ul>
                        <li>
                            <form action="/tasks/{{ $item->id }}" method="post">
                                @csrf
                                @method('PUT')
                                    <input type="hidden" name="status" value="{{ $item->status }}">
                                    <button type="submit" class="done"><i class="fa-solid fa-circle-check"></i></button>
                            </form>
                        </li>
                        <li>
                            <button type="submit" class="edit">  
                                <a href="/tasks/{{ $item->id }}/edit/"><i class="fa-solid fa-pen"></i></a>
                            </button>
                        </li>
                        <li>
                            <form onsubmit="return deleteTask();" action="/tasks/{{ $item->id}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="delete"><i class="fa-solid fa-trash"></i></button>
                            </form>
                        </li>
                    </ul>
                </div>
        @endforeach
        </div>
        @endif
    </main>

    <footer class="footer">
        To Do App
    </footer>

    <script>
        function deleteTask() {
            if (confirm('本当に削除しますか？')) {
                return true;
            }else{
                return false;
            }
        }
    </script>
</body>

</html>