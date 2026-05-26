<html>
    <head>
        @vite('resources/css/app.css')
    </head>
    <body>     
        <div style="display: flex; justify-content: flex-end; padding-right: 9px;">
            @auth
                <a href="/dashboard">Dashboard</a>
            @else
                <a href="/login">Login</a>
            @endauth
        </div>

        <form class="max-w-md mx-auto" method="GET" action="/">   
            <label for="search" class="block mb-2.5 text-sm font-medium text-heading sr-only ">Search</label>
            <div class="relative">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-body" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="m21 21-3.5-3.5M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z"/></svg>
                </div>
                <input type="search" id="search" name="search" class="block w-full p-3 ps-9 bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand shadow-xs placeholder:text-body" placeholder="Search" required />
                <button type="submit" class="absolute end-1.5 bottom-1.5 text-white bg-brand hover:bg-brand-strong box-border border border-transparent focus:ring-4 focus:ring-brand-medium shadow-xs font-medium leading-5 rounded text-xs px-3 py-1.5 focus:outline-none">Search</button>
            </div>
        </form>

        <table>
            <thead>
                <tr>
                    <th>Foto</th>
                    <th>Naam</th>
                    <th>Beschrijving</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bands as $band)
                    <tr>
                        <td> <img src="{{ asset('storage/' . $band->foto) }}" alt="{{ $band->naam }}" width="100"> </td>
                        <td> <a href="/bands/{{ $band->id }}">{{ $band->naam }}</a> </td>
                        <td>{{ $band->beschrijving }}</td>
                        
                        @auth
                            <a href="/bands/{{ $band->id }}/edit">Bewerken nmr: {{ $band->id }} </a>
                        @endauth
                    </tr>
                @endforeach
            </tbody>
        </table>

    </body>
</html>