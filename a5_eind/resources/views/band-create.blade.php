<html>
    <head>
        @vite('resources/css/app.css')
    </head>
    <body class="bg-gray-100 p-6 font-sans">
        
        <div class="max-w-2xl mx-auto mb-4">
            <a href="javascript:history.back()" class="text-blue-600 hover:underline text-sm">← Ga Terug</a>
        </div>
        
        <div class="max-w-2xl mx-auto bg-white rounded shadow p-6">
            <h2 class="text-xl font-bold mb-6 text-gray-800">Create Band</h2>

            <form method="POST" enctype="multipart/form-data" action="/bands">
                @csrf
                {{-- band naam --}}
                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Band Naam</label>
                    <input type="text" name="naam" class="border border-gray-300 rounded p-2 text-sm w-full" required>
                </div>

                {{-- genre --}}
                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Genre</label>
                    <select name="genre_id" class="border border-gray-300 rounded p-2 text-sm w-full bg-white" required>
                        @foreach($genres as $genre)
                            <option value="{{ $genre->id }}">{{ $genre->naam }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- omschrijving --}}
                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Beschrijving</label>
                    <textarea name="beschrijving" rows="3" class="border border-gray-300 rounded p-2 text-sm w-full"></textarea>
                </div>

                {{-- biografie --}}
                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Biografie</label>
                    <textarea name="biografie" rows="5" class="border border-gray-300 rounded p-2 text-sm w-full"></textarea>
                </div>

                {{-- foto --}}
                <div class="mb-4 border-t border-b border-gray-100 py-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Band Foto (Max 8MB)</label>
                    <input type="file" name="foto" id="foto" onchange="checkFotoSize(this)" class="text-sm text-gray-600">
                    <p id="foto-status" class="text-xs text-gray-500 italic mt-1">Geen foto gekozen.</p>
                    <img id="foto-preview" src="" class="w-32 h-32 object-cover rounded border border-gray-200 mt-2" style="display:none;">
                </div>

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

                {{-- vids --}}
                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">YouTube Video's</label>
                    <input type="text" name="videos[]" placeholder="YouTube URL 1" class="border border-gray-300 rounded p-2 text-sm w-full mb-2">
                    <input type="text" name="videos[]" placeholder="YouTube URL 2" class="border border-gray-300 rounded p-2 text-sm w-full mb-2">
                    <input type="text" name="videos[]" placeholder="YouTube URL 3" class="border border-gray-300 rounded p-2 text-sm w-full">
                </div>

                {{-- kleuren --}}
                <div class="flex gap-4 border-t border-gray-100 pt-4 mb-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Achtergrondkleur</label>
                        <input type="color" name="achtergrondkleur" value="{{ $band->achtergrondkleur ?? '#ffffff' }}" class="w-10 h-10 border border-gray-300 rounded">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Tekstkleur</label>
                        <input type="color" name="tekstkleur" value="{{ $band->tekstkleur ?? '#000000' }}" class="w-10 h-10 border border-gray-300 rounded">
                    </div>
                </div>

                <div class="text-right">
                    <button type="submit" class="bg-blue-600 text-white text-sm rounded px-6 py-2 hover:bg-blue-700">
                        Toevoegen
                    </button>
                </div>
            </form>
        </div>
    </body>
</html>