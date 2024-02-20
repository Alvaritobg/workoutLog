{{-- Vista Blade para mostrar las rutinas disponibles --}}
<x-app-layout>

    {{-- Slot para el encabezado de la página --}}
    <x-slot name="header">
        {{-- Título de la página --}}
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Entrenamientos del usuario
        </h2>
    </x-slot>

    @if (!$trainings->workouts->isEmpty())
        <div class="overflow-x-auto my-7 mx-5 rounded-lg border border-gray-200 ">
            @foreach ($trainings->workouts as $wo)
                <h3 class="divide-y-2 divide-gray-200 p-5 text-xl">Entrenamiento {{ $wo->order }}</h3>
                <table class="min-w-full divide-y-2 divide-gray-200 bg-white text-sm">
                    <thead class="ltr:text-left rtl:text-right">
                        <tr class="bg-gray-100">
                            <th class="whitespace-nowrap px-4 py-4 font-medium text-gray-900 text-left">Nª</th>
                            <th class="whitespace-nowrap px-4 py-4 font-medium text-gray-900 text-left">Ejercicio</th>
                            <th class="whitespace-nowrap px-4 py-4 font-medium text-gray-900 text-left">Desc</th>
                            <th class="whitespace-nowrap px-4 py-4 font-medium text-gray-900 text-left">Repeticiones a
                                realizar min/max
                            </th>
                            <th class="whitespace-nowrap px-4 py-4 font-medium text-gray-900 text-left">Repeticiones
                                obtenidas
                            </th>

                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-200">
                        @foreach ($wo->exercises as $ex)
                            <tr>
                                <td class="whitespace-nowrap px-4 py-4 font-medium text-gray-900">
                                    {{ $ex->pivot->order }}</td>
                                <td class="whitespace-nowrap px-4 py-4 font-medium text-gray-900">
                                    {{ $ex->name }}</td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700">
                                    {{ $ex->description }}</td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700">
                                    Entre {{ $ex->min_reps_desired }} / {{ $ex->max_reps_desired }} repeticiones</td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700">

                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endforeach
        </div>
        {{-- Mostrar enlaces de paginación --}}
        {{-- $users->links('vendor.pagination.tailwind') --}}
    @else
        <p>Este usuario no tiene entrenamientos registrados</p>
    @endif


</x-app-layout>
