{{-- vista para editar rutinas --}}
<script>
    // Convertir los ejercicios de PHP a JSON y asignarlos a una variable de JavaScript
    const exercises = @json($exercises);
    // Pasamos los valores old del formulario a js
    const oldWorkouts = @json(old('workouts', []));
    const routine = @json($routine);
</script>
<script src="{{ asset('js/manageWorkoutsEditRoutine.js') }}"></script>
<x-app-layout>
    {{-- Slot para el encabezado de la página --}}
    <x-slot name="header">
        {{-- Título de la página --}}
        <h1 class="font-semibold text-xl text-gray-800 leading-tight">
            Editar rutina
        </h1>
        <p>Realice cambios en las rutinas para clientes.</p>
    </x-slot>
    <div class="flex w-full">
        {{-- Modulo para mostrar mensajes de error y confirmación --}}
        <x-notification :status="session()"></x-notification>
    </div>

    <div class="flex w-full">
        <div id="errFormContainer" class="flex w-full flex-row flex-wrap items-center py-4 px-4 md:px-5 m-2 md:mx-5 gap-4 bg-red-100">
            <?xml version="1.0" encoding="UTF-8"?>
            <svg class="w-10 h-20 fill-red-400" xmlns="http://www.w3.org/2000/svg" id="Outline" viewBox="0 0 24 24"
                width="512" height="512">
                <path
                    d="M12,0A12,12,0,1,0,24,12,12.013,12.013,0,0,0,12,0Zm0,22A10,10,0,1,1,22,12,10.011,10.011,0,0,1,12,22Z" />
                <path d="M12,5a1,1,0,0,0-1,1v8a1,1,0,0,0,2,0V6A1,1,0,0,0,12,5Z" />
                <rect x="11" y="17" width="2" height="2" rx="1" />
            </svg>
            <p class="text-lg text-red-700" id="errorForm"></p>
        </div>
    </div>
    <div class="py-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 my-6 ">
            <div class="p-4 mb-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <form method="POST" id="formRutina" action="{{ route('rutinas.update', $routine->id) }}" enctype="multipart/form-data"
                        class="mt-6 space-y-6">
                        @csrf
                        @method('PUT')

                        <!-- NOMBRE -->
                        <div>
                            <x-input-label for="name" :value="__('Nombre')" />
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                                required autofocus autocomplete="name" value="{{ $routine->name }}" />
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>

                        <!-- DESC -->
                        <div>
                            <x-input-label for="description" :value="__('Descripción:')" />
                            <x-text-area id="description" name="description" type="text" class="mt-1 block w-full"
                                required autofocus :content="$routine->description">{{ $routine->description }}</x-text-area>
                            <x-input-error class="mt-2" :messages="$errors->get('description')" />
                        </div>
                        <!-- DÍAS -->
                        <div>
                            <x-input-label for="days" :value="__('Días a la semana:')" />
                            <x-text-input id="days" name="days" type="number" class="mt-1 block w-full"
                                autofocus autocomplete="days" value="{{ $routine->days }}" oninput="updateWorkouts()" />
                            <x-input-error class="mt-2" :messages="$errors->get('days')" />
                        </div>
                        <div id="workoutsContainer"></div>
                        {{-- ENTRENAMIENTOS / DIAS --}}
                        <!-- Entrenamientos -->
                        {{-- <div id="workoutsContainer">
                            {{-- Itera sobre cada entrenamiento de la rutina --}}
                            {{--@foreach ($routine->workouts as $workoutIndex => $workout)
                            <div class="workout-day" id="day-{{ $workoutIndex }}-exercises">
                                <h3>Día: {{ $workoutIndex +1 }}</h3>
                                Itera sobre cada ejercicio de este entrenamiento
                                @foreach ($workout->exercises as $exercise)
                                <div class="exercise-selector">
                                    <div class="mt-4 flex items-center">
                                        <select name="workouts[$workoutIndex +1][]" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full mr-2">
                                            @foreach ($exercises as $exerciseOption)
                                                <option value="{{ $exerciseOption->id }}" @if ($exerciseOption->id == $exercise->id) selected="selected" @endif>
                                                    {{ $exerciseOption->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                @endforeach
                                {{-- Opción para añadir más ejercicios a este entrenamiento, si necesitas una lógica específica de JS para esto, asegúrate de implementarla
                                <button type="button" onclick="addExercise({{ $workoutIndex }})">Añadir ejercicio</button>
                            </div>
                            @endforeach
                        </div> --}}
                     {{--    <button type="button" onclick="addWorkout()">Añadir entrenamiento</button> --}}
                        <!-- DURACIÓN -->
                        <div>
                            <x-input-label for="duration" :value="__('Duración en semanas:')" />
                            <x-text-input id="duration" name="duration" type="number" class="mt-1 block w-full"
                                autofocus autocomplete="duration" value="{{ $routine->duration }}" />
                            <x-input-error class="mt-2" :messages="$errors->get('duration')" />
                        </div>
                        <!-- IMG -->
                        <div>
                            <x-input-label for="img" :value="__('Imagen:')" />
                            <x-file-input id="img" name="img" class="mt-1 block w-full" autofocus
                                autocomplete="img" value="{{ $routine->img }}" />
                            <x-input-error class="mt-2" :messages="$errors->get('img')" />
                        </div>

                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            Editar rutina</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
