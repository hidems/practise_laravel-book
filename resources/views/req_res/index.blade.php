<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Request and Response/Index</title>
</head>
<body>
    <h1>Hello Request and Response/Index</h1>
    <p>{!! $msg !!}</p>
    <form action="{{ '/' . request()->path() }}" method="post">
        @csrf
        <div>NAME: <input type="text" name="name" value="{{ old('name') }}"></div>
        <div>MAIL: <input type="text" name="mail" value="{{ old('mail') }}"></div>
        <div>TEL: <input type="text" name="tel" value="{{ old('tel') }}"></div>
        <input type="submit">
    </form>
    <hr>
    <ol>
        @for($i = 0; $i < count($keys); $i++)
            <li>{{ $keys[$i] }}:{{ $values[$i] }}</li>
        @endfor
    </ol>
</body>
