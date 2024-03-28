{{-- Vista Blade para registrar los entrenamientos --}}
<x-app-layout>
    <div class="flex w-full">
        <div id="dynamicNotification"
            class="hidden flex w-full flex-row flex-wrap items-center py-4 px-4 md:px-5 my-4 mx-2 md:mx-5 gap-4">
            <svg class="w-10 h-20" xmlns="http://www.w3.org/2000/svg" id="Outline" viewBox="0 0 24 24" width="512"
                height="512"></svg>
            <p id="dynamicNotificationText" class="text-lg"></p>
        </div>
    </div>
    <div class="flex w-full">
        {{-- Modulo para mostrar mensajes de error y confirmación --}}
        <x-notification :status="session()"></x-notification>
    </div>
    {{-- Verifica si hay rutinas disponibles --}}
    @if ($workoutExercises)
        {{-- $routine --}}
        <div class="flex flex-col py-2 px-2 md:px-5 my-4 gap-4 justify-center">
            {{-- <div class="flex flex-col text-end text-white p-6 max-h-60 overflow-hidden shadow-md rounded-sm
                    h-screen bg-cover bg-center"
                style="background-image: url('/images/{{ $routine->img }}')">

            </div> --}}

            <div class="divide-y divide-gray-100 border border-gray-100 bg-white p-5 shadow-md rounded-sm">

                <h2 class="text-2xl mb-3 font-black">{{ $workoutExercises->name }}</h2>
                <form method="POST" action="{{ route('workouts.store') }}">
                    @csrf
                    <input type="hidden" name="workoutId" id="workoutId" value="{{ $nextWorkoutId }}">
                    <input type="hidden" name="routineId" id="routineId" value="{{ $routineId }}">
                    @foreach ($workoutExercises->exercises as $exercise)
                        <div class="border rounded my-2 p-2">
                            <h3 class="my-2 text-xl font-light ml-1 flex">{{ $exercise->name }}
                                <a href="{{ $exercise->info }}" target="_blank">
                                    <svg xmlns="http://www.w3.org/2000/svg" id="Bold" viewBox="0 0 24 24"
                                        class="ml-2 mt-1 w-4 h-4 fill-black">
                                        <path
                                            d="M12,0A12,12,0,1,0,24,12,12.013,12.013,0,0,0,12,0Zm0,22A10,10,0,1,1,22,12,10.011,10.011,0,0,1,12,22Z" />
                                        <path d="M12,10H11a1,1,0,0,0,0,2h1v6a1,1,0,0,0,2,0V12A2,2,0,0,0,12,10Z" />
                                        <circle cx="12" cy="6.5" r="1.5" />
                                    </svg>
                                </a>
                            </h3>
                            <table class="min-w-full divide-y-2 divide-gray-200 bg-white text-sm">
                                <thead class="ltr:text-left rtl:text-right">
                                    <tr class="bg-gray-100">
                                        <th
                                            class="whitespace-nowrap px-4 py-4 font-medium text-gray-900 text-left max-w-10">
                                            Serie
                                        </th>
                                        <th
                                            class="whitespace-nowrap px-4 py-4 font-medium text-gray-900 text-left max-w-14">
                                            Objetivo
                                        </th>
                                        <th
                                            class="whitespace-nowrap px-4 py-4 font-medium text-gray-900 text-left max-w-14">
                                            Peso
                                        </th>
                                        <th
                                            class="whitespace-nowrap px-4 py-4 font-medium text-gray-900 text-left max-w-14">
                                            Repeticiones
                                        </th>

                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200">
                                    @for ($i = 1; $i <= $exercise->num_series; $i++)
                                        <tr>
                                            <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 max-w-10">
                                                {{ $i }}
                                            </td>
                                            <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 max-w-14">
                                                {{ $exercise->min_reps_desired . '/' . $exercise->max_reps_desired . 'reps.' }}
                                            </td>
                                            <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 max-w-14">
                                                <x-text-input
                                                    id="exercises[{{ $exercise->id }}][series][{{ $i }}][used_weight]"
                                                    name="exercises[{{ $exercise->id }}][series][{{ $i }}][used_weight]"
                                                    value="" type="number" class="mt-1 block w-16 md:w-full"
                                                    required autofocus />
                                                <x-input-error class="mt-2" :messages="$errors->get(
                                                    'exercises[{{ $exercise->id }}][series][{{ $i }}][used_weight]',
                                                )" />
                                            </td>
                                            <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 max-w-14">
                                                <x-text-input
                                                    id="exercises[{{ $exercise->id }}][series][{{ $i }}][repetitions]"
                                                    name="exercises[{{ $exercise->id }}][series][{{ $i }}][repetitions]"
                                                    value="" type="number" class="mt-1 block w-16 md:w-full"
                                                    required autofocus />
                                                <x-input-error class="mt-2" :messages="$errors->get(
                                                    'exercises[{{ $exercise->id }}][series][{{ $i }}][repetitions]',
                                                )" />
                                            </td>
                                        </tr>
                                    @endfor
                                </tbody>
                            </table>
                        </div>
                    @endforeach
                    <button type="submit"
                        class="inline-flex items-center h-12 px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">Registrar
                        Entrenamiento
                    </button>
                </form>
            </div>
        </div>
    @else
        {{-- Mensaje si no hay rutinas disponibles --}}
        <p>No hay ejercicios, contacta con tu entrenador.</p>
    @endif

</x-app-layout>


{{-- old ---------------------------------------------- --}}
{{-- <div class="container">
    <h1>Registrar Entrenamiento</h1>
    <form method="POST" action="{{ route('workouts.store') }}">
        @csrf

        <input type="hidden" name="workoutId" id="workoutId" value="{{ $nextWorkoutId }}">
        <input type="hidden" name="routineId" id="routineId" value="{{ $routineId }}">
        @foreach ($workoutExercises->exercises as $exercise)
            <h3>{{ $exercise->name . ' - Entre ' . $exercise->min_reps_desired . '/' . $exercise->max_reps_desired . ' repeticiones.' }}
            </h3>
            @for ($i = 1; $i <= $exercise->num_series; $i++)
                <div class="mb-3">

                    <label>{{ "Serie $i - Peso Usado" }}</label>
                    <input type="number"
                        name="exercises[{{ $exercise->id }}][series][{{ $i }}][used_weight]"
                        class="form-control" required>
                    <label>{{ "Serie $i - Repeticiones" }}</label>
                    <input type="number"
                        name="exercises[{{ $exercise->id }}][series][{{ $i }}][repetitions]"
                        class="form-control" required>
                </div>
            @endfor
        @endforeach

        <button type="submit" class="btn btn-primary">Registrar Entrenamiento</button>
    </form>
</div> --}}
