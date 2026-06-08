<html>
    <head>
        @vite('resources/css/app.css')
    </head>
    <body class="bg-gray-100 p-6 font-sans">
        @use('Illuminate\Support\Facades\Storage')
        
        <div class="max-w-2xl mx-auto mb-4">
            <a href="../../dashboard" class="text-blue-600 hover:underline text-sm">← Dashboard</a>
        </div>
        
        <div class="max-w-2xl mx-auto bg-white rounded shadow p-6">
            <h2 class="text-xl font-bold mb-6 text-gray-800">Band Aanpassen: {{ $band->naam }}</h2>

            <form method="POST" enctype="multipart/form-data" action="/bands/{{ $band->id }}">
                @csrf
                @method('PUT')
                
                {{-- band naam --}}
                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Band Naam</label>
                    <input type="text" name="naam" required value="{{ $band->naam }}" class="border border-gray-300 rounded p-2 text-sm w-full">
                </div>

                {{-- genres --}}
                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Genre</label>
                    <select name="genre_id" class="border border-gray-300 rounded p-2 text-sm w-full bg-white" required>
                        @foreach($genres as $genre) 
                            <option value="{{ $genre->id }}" {{ $band->genre_id == $genre->id ? 'selected' : '' }}> {{ $genre->naam }} </option> 
                        @endforeach
                    </select>
                </div>

                {{-- omschrijving --}}
                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Korte Beschrijving</label>
                    <textarea name="beschrijving" rows="3" class="border border-gray-300 rounded p-2 text-sm w-full">{{ $band->beschrijving }}</textarea>
                </div>

                {{-- biografie --}}
                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Biografie</label>
                    <textarea name="biografie" rows="5" class="border border-gray-300 rounded p-2 text-sm w-full">{{ $band->biografie }}</textarea>
                </div>

                {{-- foto --}}
                <div class="mb-4 border-t border-b border-gray-100 py-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Band Foto Aanpassen (Max 8MB)</label>
                    <input type="file" name="foto" id="foto" onchange="checkFotoSize(this)" class="text-sm text-gray-600 mb-3">

                    <script>
                        function checkFotoSize(input) {
                            if (input.files[0].size > 8388608) {
                                alert('Foto is te groot! Maximum is 8MB.');
                                input.value = '';
                                document.getElementById('foto-status').textContent = 'Geen foto geüpload.';
                            } else {
                                document.getElementById('foto-status').textContent = 'Gekozen: ' + input.files[0].name;
                                
                                const reader = new FileReader();
                                reader.onload = function(e) {
                                    document.getElementById('foto-preview').src = e.target.result;
                                    document.getElementById('foto-preview').style.display = 'block';
                                }
                                reader.readAsDataURL(input.files[0]);
                            }
                        }
                    </script>
                    
                    @if($band->foto)
                        <div class="bg-gray-50 p-3 rounded border border-gray-200 inline-block">
                            <p class="text-xs font-semibold text-gray-600 mb-1">Huidige foto:</p>
                            <img id="foto-preview" src="{{ asset('storage/' . $band->foto) }}" class="w-32 h-32 object-cover rounded shadow-xs mb-2">
                            <p id="foto-status" class="text-xs text-gray-500 italic mb-2">Huidige foto aanwezig</p>
                            
                            <button type="button" class="text-xs bg-red-100 text-red-700 px-2 py-1 rounded hover:bg-red-200 transition" onclick="
                                document.getElementById('foto-preview').style.display='none';
                                document.getElementById('foto_verwijderen').value='1';
                                this.style.display='none';
                            ">Foto verwijderen</button>
                            <input type="hidden" name="foto_verwijderen" id="foto_verwijderen" value="0">
                        </div>
                    @else
                        <p id="foto-status" class="text-xs text-gray-500 italic">Geen foto geüpload.</p>
                    @endif
                </div>

                {{-- videos --}}
                @php $videoUrls = $band->videos->pluck('url')->toArray(); @endphp
                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">YouTube Video's</label>
                    
                    <div class="flex gap-2 mb-2">
                        <input type="text" name="videos[]" value="{{ $videoUrls[0] ?? '' }}" id="video1" class="border border-gray-300 rounded p-2 text-sm flex-1">
                        <button type="button" class="bg-gray-200 text-gray-700 px-3 rounded hover:bg-gray-300 text-sm font-bold" onclick="document.getElementById('video1').value=''">X</button>
                    </div>
                    <div class="flex gap-2 mb-2">
                        <input type="text" name="videos[]" value="{{ $videoUrls[1] ?? '' }}" id="video2" class="border border-gray-300 rounded p-2 text-sm flex-1">
                        <button type="button" class="bg-gray-200 text-gray-700 px-3 rounded hover:bg-gray-300 text-sm font-bold" onclick="document.getElementById('video2').value=''">X</button>
                    </div>            
                    <div class="flex gap-2">
                        <input type="text" name="videos[]" value="{{ $videoUrls[2] ?? '' }}" id="video3" class="border border-gray-300 rounded p-2 text-sm flex-1">
                        <button type="button" class="bg-gray-200 text-gray-700 px-3 rounded hover:bg-gray-300 text-sm font-bold" onclick="document.getElementById('video3').value=''">X</button>
                    </div>
                </div>

                {{-- kleuren --}}
                <div class="flex gap-4 border-t border-gray-100 pt-4 mb-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Achtergrondkleur</label>
                        <input type="color" name="achtergrondkleur" value="{{ $band->achtergrondkleur ?? '#ffffff' }}" class="w-10 h-10 border border-gray-300 rounded cursor-pointer">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Tekstkleur</label>
                        <input type="color" name="tekstkleur" value="{{ $band->tekstkleur ?? '#000000' }}" class="w-10 h-10 border border-gray-300 rounded cursor-pointer">
                    </div>
                </div>
                
                {{-- mail toevoegen aan bands --}}
                <div class="border-t border-gray-100 pt-4 mb-6">
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Band Delen (Email)</label>
                    <input type="email" name="gebruiker_toevoegen" class="border border-gray-300 rounded p-2 text-sm w-full mb-3">
                    
                    <p class="text-sm font-semibold text-gray-700 mb-1">Huidige beheerders:</p>
                    <div class="bg-gray-50 p-3 rounded border border-gray-200 flex flex-col gap-1">
                        @foreach($band->users as $user)
                            <p class="text-sm text-gray-600 font-medium select-all">{{ $user->email }}</p>
                        @endforeach
                    </div>
                </div>

                <div class="text-right">
                    <button type="submit" class="bg-blue-600 text-white text-sm rounded px-6 py-2 hover:bg-blue-700 transition">
                        Wijzigingen Opslaan
                    </button>
                </div>
            </form>
        </div>
    </body>
</html>