<!DOCTYPE html>
<html>
    <head>
        @vite('resources/css/app.css')
    </head>
    <body style="background-color: {{ $band->achtergrondkleur }}; color: {{ $band->tekstkleur }};">
        <a href="../../dashboard">Dashboard</a>


        <h1>{{ $band->naam }}</h1>
        <img src="{{ asset('storage/' . $band->foto) }}" alt="{{ $band->naam }}" width="200">
        <p>{{ $band->beschrijving }}</p>
        <p>{{ $band->biografie }}</p>

        @foreach($band->videos as $video)
            <iframe width="560" height="315" src="{{ $video->getEmbedUrl() }}" frameborder="0" allowfullscreen></iframe>
        @endforeach

        @auth
            <a href="/bands/{{ $band->id }}/edit">Edit</a>
        @endauth
    </body>
</html>