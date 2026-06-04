{{-- 
    px- / py- = padding horizontaal / padding verticaal ( dus ook mx- / my- )
    gap- = tussenruimte tussen elementen die naast elkaar staan
    justify-between = duwt het eerste element helemaal naar links en het tweede element helemaal naar rechts
    divide-y = zet automatisch een horizontale streep
--}}

<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Dashboard') }}
            </h2>
            <a href="../" class="text-sm text-gray-600 dark:text-gray-400 hover:underline">← Naar Home</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Jouw Bands</h3>
                        <a href="/bands/create" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 text-sm font-medium transition">
                            + Create Band
                        </a>
                    </div>

                    <div class="overflow-x-auto border border-gray-100 dark:border-gray-700 rounded-lg">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-gray-50 dark:bg-gray-700/50 border-b border-gray-200 dark:border-gray-700 text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">
                                    <th class="px-6 py-3">Band Naam</th>
                                    <th class="px-6 py-3 text-right">Acties</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                                @foreach($bands as $band)
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/30 transition">
                                        <td class="px-6 py-4">
                                            <a href="/bands/{{ $band->id }}" class="text-sm font-medium text-blue-600 dark:text-blue-400 hover:underline">
                                                {{ $band->naam }}
                                            </a>
                                        </td>
                                        <td class="px-6 py-4 text-right text-sm">
                                            <a href="/bands/{{ $band->id }}/edit" class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white font-medium">
                                                Bewerken
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>  
            </div>
        </div>
    </div>
</x-app-layout>