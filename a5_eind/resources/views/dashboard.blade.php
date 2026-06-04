{{-- 
    px- / py- = padding horizontaal / padding verticaal ( dus ook mx- / my- )
    gap- = tussenruimte tussen elementen die naast elkaar staan
    justify-between = duwt het eerste element helemaal naar links en het tweede element helemaal naar rechts
    divide-y = zet automatisch een horizontale streep
--}}

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
            <a href="../" class="text-xs">- Home </a>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    @foreach($bands as $band)
                        <a href="/bands/{{ $band->id }}">{{ $band->naam }}</a> <br>
                    @endforeach

                    <br>
                    <a href="/bands/create"> Create Band </a>
                </div>  
            </div>
        </div>
    </div>
</x-app-layout>
