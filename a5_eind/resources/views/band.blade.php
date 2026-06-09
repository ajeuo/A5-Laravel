<!DOCTYPE html>
<html>
    <head>
        @vite('resources/css/app.css')
    </head>
    <body class="font-sans min-h-screen p-6" style="background-color: {{ $band->achtergrondkleur }}; color: {{ $band->tekstkleur }};">
        
        <div class="max-w-4xl mx-auto flex justify-between items-center mb-8 border-b pb-4 border-current/20">
            <a href="../../dashboard" class="hover:underline font-medium text-sm">← Dashboard</a>
            
            @auth
                <a href="/bands/{{ $band->id }}/edit" class="bg-blue-600 text-white text-xs font-semibold px-4 py-2 rounded hover:bg-blue-700 transition">
                    Edit Band
                </a>
            @endauth
        </div>

        <main class="max-w-4xl mx-auto">
            
            {{-- foto --}}
            <div class="flex flex-col md:flex-row gap-8 items-center md:items-start mb-10">
                <img src="{{ asset('storage/' . $band->foto) }}" alt="{{ $band->naam }}" class="w-64 h-64 object-cover rounded-lg shadow-md border border-current/10">
                
                {{-- naam & beschrijving --}}
                <div class="flex-1 text-center md:text-left">
                    <h1 class="text-4xl md:text-5xl font-black tracking-tight mb-4">{{ $band->naam }}</h1>
                    <p class="text-lg font-medium opacity-90 leading-relaxed max-w-2xl">{{ $band->beschrijving }}</p>
                </div>
            </div>

            {{-- bio --}}
            <div class="mb-12 border-t pt-6 border-current/10">
                <h2 class="text-xl font-bold mb-3 uppercase tracking-wider opacity-80">Biografie</h2>
                <p class="whitespace-pre-line leading-relaxed opacity-90">{{ $band->biografie }}</p>
            </div>

            {{-- vids --}}
            @if($band->videos->count() > 0)
                <div class="border-t pt-6 border-current/10">
                    <h2 class="text-xl font-bold mb-6 uppercase tracking-wider opacity-80">Media & Video's</h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @foreach($band->videos as $video)
                            <div class="aspect-video w-full rounded-lg overflow-hidden shadow-sm">
                                <iframe class="w-full h-full" src="{{ $video->getEmbedUrl() }}" frameborder="0" allowfullscreen></iframe>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

        </main>
    </body>
</html>