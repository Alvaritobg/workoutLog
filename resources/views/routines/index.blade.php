<x-app-layout>

    {{-- Slot para el encabezado de la página --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{'Rutinas disponibles'}}
        </h2>
        <p>Seleccione la rutina que quiera realizar</p>
    </x-slot>

    {{-- Contenedor principal --}}
    @if ($routines)
    @foreach ($routines as $routine)
    <a href="#"><!-- sustituir url -->
    <div class="py-2">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 ">
            <div class="flex flex-col text-end relative text-white p-6 max-h-60 overflow-hidden shadow-md sm:rounded-sm bg-[url(https://images.unsplash.com/photo-1534438327276-14e5300c3a48?q=80&w=1470&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D)] h-screen bg-cover bg-center">
                <h3 class="font-bold text-3xl drop-shadow-sm bottom-0 right-0">{{ $routine->name }}</h3>
                <p class="font-thin bottom-0 right-0">Creador: {{ $routine->user_id }}</p>
                <p class="font-extralightdrop-shadow-lg bottom-0 right-0">{{ $routine->description }}</p>
            </div>
        </div>
    </div>
</a>
    @endforeach
    @else
        <p>No se encontraron ejercicios para este entrenamiento.</p>
    @endif

</x-app-layout>