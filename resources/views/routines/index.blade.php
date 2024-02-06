{{-- Vista Blade para mostrar las rutinas disponibles --}}
<x-app-layout>

    {{-- Slot para el encabezado de la página --}}
    <x-slot name="header">
        {{-- Título de la página --}}
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ 'Rutinas disponibles' }}
        </h2>
        {{-- Subtítulo o descripción adicional --}}
        <p>Seleccione la rutina que quiera realizar</p>
    </x-slot>

    {{-- Contenedor principal --}}
    {{-- Verifica si hay rutinas disponibles --}}
    @if ($routines)

        {{-- Bucle para iterar sobre cada rutina --}}
        <div class="flex flex-col lg:flex-row flex-wrap py-2 px-2 md:px-5 my-4 gap-4 justify-around">
            @foreach ($routines as $routine)
                <div class="basis-0 md:basis-5/12 grow">
                    {{-- Asignación de la imagen de la rutina a una variable PHP --}}
                    @php
                        $routineImg = $routine->img;
                    @endphp

                    {{-- Enlace para cada rutina --}}
                    <a href="{{ route('routine.show', ['id' => $routine->id]) }}">
                        {{-- Contenedor de la rutina --}}
                        {{-- <div class="py-2 px-0 md:px-5 lg:px-10 xl:px-20"> --}}
                        <div class="max-w-7xl mx-auto ">
                            {{-- Tarjeta de rutina con imagen de fondo y texto --}}
                            <div
                                class="flex flex-col text-end text-white p-6 max-h-60 overflow-hidden shadow-md rounded-sm 
                    bg-[url(https://images.unsplash.com/photo-1534438327276-14e5300c3a48?q=80&w=1470&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D)]
                    h-screen bg-cover bg-center hover:grayscale">
                                {{-- Información de la rutina --}}
                                <div class="flex flex-col justify-end flex-grow">
                                    {{-- Nombre de la rutina --}}
                                    <h3
                                        class="font-bold text-4xl drop-shadow-[0_1.2px_1.2px_rgba(0,0,0,0.8)] border-black">
                                        {{ $routine->name }}</h3>
                                    {{-- Descripción de la rutina --}}
                                    <p class="font-extralightdrop-shadow-lg drop-shadow-[0_1.2px_1.2px_rgba(0,0,0,0.8)]">
                                        {{ $routine->description }}</p>
                                    {{-- Información del entrenador de la rutina --}}
                                    <p class="font-thin text-xs drop-shadow-[0_1.2px_1.2px_rgba(0,0,0,0.8)]">
                                        Trainer:
                                        {{ $routine->user->name }} {{ $routine->user->surname }}</p>
                                </div>
                            </div>
                        </div>
                        {{-- </div> --}}
                    </a>
                </div>
            @endforeach
        </div>
    @else
        {{-- Mensaje si no hay rutinas disponibles --}}
        <p>No se encontraron ejercicios para este entrenamiento.</p>
    @endif

</x-app-layout>
