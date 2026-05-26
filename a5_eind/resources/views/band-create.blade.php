<html>
    <head>

    </head>
    <body>
        <a href="javascript:history.back()">Go Back</a>
        
        <form method="POST" enctype="multipart/form-data" action="/bands">
            @csrf
            
            <input type="text" name="naam" value="">
            <select name="genre_id">
                @foreach($genres as $genre)
                    <option value="{{ $genre->id }}">{{ $genre->naam }}</option>
                @endforeach
            </select>

            <textarea name="beschrijving"></textarea>
            <textarea name="biografie"></textarea>

            <input type="file" name="foto" id="foto" onchange="checkFotoSize(this)">
            <p id="foto-status">Geen foto gekozen.</p>
            <img id="foto-preview" src="" width="100" style="display:none;">

            <script>
            function checkFotoSize(input) {
                if (input.files[0].size > 8388608) {
                    alert('Foto is te groot! Maximum is 8MB.');
                    input.value = '';
                    document.getElementById('foto-status').textContent = 'Geen foto gekozen.';
                    document.getElementById('foto-preview').style.display = 'none';
                } else {
                    document.getElementById('foto-status').textContent = 'Gekozen: ' + input.files[0].name;
                    
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const preview = document.getElementById('foto-preview');
                        preview.src = e.target.result;
                        preview.style.display = 'block';
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }
            </script>

            <input type="text" name="videos[]" placeholder="YouTube URL 1">
            <input type="text" name="videos[]" placeholder="YouTube URL 2">
            <input type="text" name="videos[]" placeholder="YouTube URL 3">

            <input type="color" name="achtergrondkleur" value="{{ $band->achtergrondkleur ?? '#ffffff' }}">
            <input type="color" name="tekstkleur" value="{{ $band->tekstkleur ?? '#000000' }}">


            <br> <button type="submit">Opslaan</button>
        </form>
    </body>
</html>