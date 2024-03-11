<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TEST</title>
</head>
<body>
@if($todolists->isNotEmpty())
        <ul>
            @foreach($todolists as $item)
            <li>
                    {{ $item->name }}
            </li>
            @endforeach
        </ul>
    @endif
</body>
</html>