<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
</head>
<body>
<h2>{{ $title }}</h2>

<div>
    {!! $intro .' '. link_to('new/password/' . $confirmation_code, $link) !!}.<br>
</div>
</body>
</html>