<html>
    <head>
        
    </head>
    <body>
        @use('Illuminate\Support\Facades\Storage')
        <a href="../../dashboard">Dashboard</a>

        <form method="POST" enctype="multipart/form-data" action="/bands/{{ $band->id }}">
            @csrf
            @method('PUT')
            
            <input type="text" name="naam" value="{{ $band->naam }}">
            <select name="genre_id">
                @foreach($genres as $genre) 
                    <option value="{{ $genre->id }}" {{ $band->genre_id == $genre->id ? 'selected' : '' }}> {{ $genre->naam }} </option> 
                @endforeach
            </select>

            <textarea name="beschrijving">{{ $band->beschrijving }}</textarea>
            <textarea name="biografie">{{ $band->biografie }}</textarea>

            <input type="file" name="foto" id="foto" onchange="checkFotoSize(this)">

            {{-- voor als foto te groot is (max is 8mb) --}}
            <script>
                function checkFotoSize(input) {
                    if (input.files[0].size > 8388608) {
                        alert('Foto is te groot! Maximum is 8MB.');
                        input.value = '';
                        document.getElementById('foto-status').textContent = 'Geen foto geüpload.';
                    } else {
                        document.getElementById('foto-status').textContent = 'Gekozen: ' + input.files[0].name;
                        
                        // Live preview
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            document.getElementById('foto-preview').src = e.target.result;
                        }
                        reader.readAsDataURL(input.files[0]);
                    }
                }
            </script>
            
            {{-- laat het foto zien in het edit formulier voor duidelijkheid --}}
            @if($band->foto)
                <p>Huidige foto:</p>
                <img id="foto-preview" src="{{ asset('storage/' . $band->foto) }}" width="100">
                <p id="foto-status">
                    @if($band->foto) Huidige foto aanwezig @else Geen foto geüpload. @endif
                </p>
                <button type="button" onclick="
                        document.getElementById('foto-preview').style.display='none';
                        document.getElementById('foto_verwijderen').value='1';
                    ">Foto verwijderen</button>
                    <input type="hidden" name="foto_verwijderen" id="foto_verwijderen" value="0">
x            @else
                <p>Geen foto geüpload.</p>
            @endif


            @php $videoUrls = $band->videos->pluck('url')->toArray(); @endphp

            <div>
                <input type="text" name="videos[]" value="{{ $videoUrls[0] ?? '' }}" id="video1">
                <button type="button" onclick="document.getElementById('video1').value=''">X</button>
            </div>
            <div>
                <input type="text" name="videos[]" value="{{ $videoUrls[1] ?? '' }}" id="video2">
                <button type="button" onclick="document.getElementById('video2').value=''">X</button>
            </div>            
            <div>
                <input type="text" name="videos[]" value="{{ $videoUrls[2] ?? '' }}" id="video1">
                <button type="button" onclick="document.getElementById('video3').value=''">X</button>
            </div>


            <input type="color" name="achtergrondkleur" value="{{ $band->achtergrondkleur ?? '#ffffff' }}">
            <input type="color" name="tekstkleur" value="{{ $band->tekstkleur ?? '#000000' }}">
            
            
            <input type="email" name="gebruiker_toevoegen" placeholder="Share band">
            <p>Huidige beheerders:</p>
            @foreach($band->users as $user)
            <p>{{ $user->email }}</p>
            @endforeach

            <br> <button type="submit">Opslaan</button>
        </form>
    </body>
</html>