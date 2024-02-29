{{-- vista para crear rutinas --}}
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
    <div class="py-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 my-6 ">
            <div class="p-4 mb-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <form method="POST" action="{{ route('rutinas.update', $routine->id) }}" enctype="multipart/form-data"
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
                                required autofocus :content="$routine->description"></x-text-area>
                            <x-input-error class="mt-2" :messages="$errors->get('description')" />
                        </div>
                        <!-- DÍAS -->
                        <div>
                            <x-input-label for="days" :value="__('Días a la semana:')" />
                            <x-text-input id="days" name="days" type="number" class="mt-1 block w-full"
                                autofocus autocomplete="days" value="{{ $routine->days }}" />
                            <x-input-error class="mt-2" :messages="$errors->get('days')" />
                        </div>
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
