<script>
    // Convertir los ejercicios de PHP a JSON y asignarlos a una variable de JavaScript
    const exercises = @json($exercises);
    // Pasamos los valores old del formulario a js
    const oldWorkouts = @json(old('workouts', []));
</script>
<script src="{{ asset('js/manageWorkoutsNewRoutine.js') }}"></script>
{{-- vista para crear rutinas --}}
<x-app-layout>
    {{-- Slot para el encabezado de la página --}}
    <x-slot name="header">
        {{-- Título de la página --}}
        <h1 class="font-semibold text-xl text-gray-800 leading-tight">
            Crear rutina
        </h1>
        <p>Aqui puede crear rutinas para sus clientes.</p>

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
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 my-6">
            <div class="p-4 mb-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <form id="formRutina" method="POST" action="{{ route('rutinas.store') }}" enctype="multipart/form-data"
                        class="mt-6 space-y-6">
                        @csrf


                        <!-- NOMBRE -->
                        <div>
                            <x-input-label for="name" :value="__('Nombre')" />
                            <x-text-input id="name" name="name" value="{{ old('name') }}" type="text" class="mt-1 block w-full"
                                required autofocus autocomplete="name" />
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>

                        <!-- DESC -->
                        <div>
                            <x-input-label for="description" :value="__('Descripción:')" />
                            <x-text-area id="description" name="description" type="text" class="mt-1 block w-full"
                                required autofocus> {{ old('description') }}</x-text-area>
                            <x-input-error class="mt-2" :messages="$errors->get('description')" />
                        </div>
                        <!-- DÍAS -->

                        <div>
                            <x-input-label for="days" :value="__('Días a la semana:')" />
                            <x-text-input id="days" name="days" value="{{ old('days') }}" min=1 max=7 type="number"
                                class="mt-1 block w-full" autofocus autocomplete="days" oninput="updateWorkouts()" />
                            <x-input-error class="mt-2" :messages="$errors->get('days')" />
                        </div>

                        <div id="workoutsContainer"></div>
                        <!-- DURACIÓN -->
                        <div>
                            <x-input-label for="duration" :value="__('Duración en semanas:')" />
                            <x-text-input id="duration" name="duration" value="{{ old('duration') }}" type="number" class="mt-1 block w-full"
                                autofocus autocomplete="duration" />
                            <x-input-error class="mt-2" :messages="$errors->get('duration')" />
                        </div>
                        <!-- IMG -->
                        <div>
                            <x-input-label for="img" :value="__('Imagen:')" />
                            <x-file-input id="img" name="img" class="mt-1 block w-full" autofocus
                                autocomplete="img" />
                            <x-input-error class="mt-2" :messages="$errors->get('img')" />
                        </div>
                        <div id="errorGeneral" style="display: none;">
                            <!-- Mensajes de error del lado del cliente aparecerán aquí -->
                        </div>
                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">Crear
                            Rutina</button>

                    </form>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
