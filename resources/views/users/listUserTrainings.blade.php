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

        @foreach ($trainings->workouts as $wo)
            <div class="overflow-x-auto my-7 mx-5 rounded-lg border border-gray-200 ">
                <h3 class="divide-y-2 divide-gray-200 p-5 text-xl">{{ $wo->name }}</h3>
                <table class="min-w-full divide-y-2 divide-gray-200 bg-white text-sm">
                    <thead class="ltr:text-left rtl:text-right">
                        <tr class="bg-gray-100">
                            <th class="whitespace-nowrap px-4 py-4 font-medium text-gray-900 text-left">Nª</th>
                            <th class="whitespace-nowrap px-4 py-4 font-medium text-gray-900 text-left">Ejercicio</th>
                            <th class="whitespace-nowrap px-4 py-4 font-medium text-gray-900 text-left">Desc</th>
                            <th class="whitespace-nowrap px-4 py-4 font-medium text-gray-900 text-left">Rep objetivo
                                min/max
                            </th>
                            <th class="whitespace-nowrap px-4 py-4 font-medium text-gray-900 text-left">NºSerie/Rep
                                conseguidas/Peso usado
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
                                    @foreach ($ex->series as $serie)
                                        <ul>
                                            <li
                                                class="my-2 p-2 rounded-sm border border-b-1 border-solid border-gray-200 text-center bg-gray-100 cursor-pointer">
                                                <b>{{ $serie->number }}ª</b> :
                                                {{ $serie->repetitions }}
                                                repeticiones con
                                                {{ $serie->used_weight }} kg
                                            </li>
                                        </ul>
                                    @endforeach
                                </td>
                                {{--  <td class="whitespace-nowrap px-4 py-2 text-gray-700">
                                    @foreach ($ex->series as $serie)
                                        {{ $serie->number }}ª<br />
                                    @endforeach
                                </td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700">
                                    @foreach ($ex->series as $serie)
                                        {{ $serie->used_weight }}<br>
                                    @endforeach
                                </td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700">
                                    @foreach ($ex->series as $serie)
                                        {{ $serie->used_weight }}kg<br>
                                    @endforeach
                                </td> --}}

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endforeach
        </div>
        {{-- Mostrar enlaces de paginación --}}
        {{-- $users->links('vendor.pagination.tailwind') --}}
    @else
        <div class="overflow-x-auto my-7 mx-5 rounded-lg border border-gray-200 p-4 text-center">
            <p>Este usuario no tiene entrenamientos registrados</p>
        </div>
    @endif


</x-app-layout>
