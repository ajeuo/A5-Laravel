<html>
    {{-- 
        mb- / mt- = margin bottom / margin top
        p- = padding.
        w- / h- = width / height
        cijfer value achter - is keer 4. dus h-16 = 64 pixels
        mx-auto = Centreert een element in het midden van het scherm. 
    --}}

    <head>
        @vite('resources/css/app.css')
    </head>
    <body class="bg-gray-100 p-6 font-sans">     
        
        <div class="flex justify-end gap-4 mb-6">
            @auth
                <a href="/dashboard" class="text-blue-600 hover:underline">Dashboard</a>
            @else
                <a href="/login" class="text-blue-600 hover:underline">Login</a>
            @endauth
        </div>

        <form class="max-w-md mx-auto mb-8" method="GET" action="/">   
            <label for="search" class="sr-only">Search</label>
            <div class="flex items-center gap-2">
                <div class="relative flex-1">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="m21 21-3.5-3.5M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z"/></svg>
                    </div>
                    <input type="search" id="search" name="search" class="block w-full p-2 ps-9 bg-white border border-gray-300 text-sm rounded" placeholder="Search" />
                </div>
                <button type="submit" class="bg-blue-600 text-white font-medium text-sm rounded px-4 py-2 hover:bg-blue-700">Search</button>
            </div>
        </form>

        <div class="max-w-4xl mx-auto bg-white rounded shadow p-4">
            <table class="w-full text-left">
                <thead>
                    <tr class="border-b-2 border-gray-200 text-gray-700">
                        <th class="pb-3">Foto</th>
                        <th class="pb-3">Naam</th>
                        <th class="pb-3">Beschrijving</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($bands as $band)
                        <tr class="border-b border-gray-100 hover:bg-gray-50">
                            <td class="py-3"> 
                                <img src="{{ asset('storage/' . $band->foto) }}" alt="{{ $band->naam }}" class="w-16 h-16 object-cover rounded"> 
                            </td>
                            <td class="py-3 font-semibold text-blue-600 hover:underline"> 
                                <a href="/bands/{{ $band->id }}">{{ $band->naam }}</a> 
                            </td>
                            <td class="py-3 text-gray-600">{{ $band->beschrijving }}</td>
                            
                            {{-- @auth
                                <td class="py-3 text-right">
                                    <a href="/bands/{{ $band->id }}/edit" class="text-green-600 hover:underline">Bewerken</a>
                                </td>
                            @endauth --}}
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </body>
</html>