<!DOCTYPE html>
<html>
    <head>
        @vite('resources/css/app.css')
    </head>
    <body>
        <a href="../">Home</a> <br>

        <h1>{{ $band->naam }}</h1>
        <img src="{{ $band->foto }}" alt="{{ $band->naam }}">
        <p>{{ $band->beschrijving }}</p>
        <p>{{ $band->biografie }}</p>
    </body>
</html>