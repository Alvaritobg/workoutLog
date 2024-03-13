{{-- Vista Blade para mostrar las rutinas disponibles --}}
<x-app-layout>

    {{-- Slot para el encabezado de la página --}}
    <x-slot name="header">
        {{-- Título de la página --}}
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ 'Rutinas' }}
        </h2>
        {{-- Subtítulo o descripción adicional --}}
        <p>Listado de rutinas disponibles.</p>
    </x-slot>

    <div class="py-3 ">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 ">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg ">
                {{-- Contenedor principal --}}
                <div class="flex w-full">
                    {{-- Modulo para mostrar mensajes de error y confirmación --}}
                    <x-notification :status="session()"></x-notification>
                </div>
                {{-- muestra si eres admin / trainer --}}
                @auth
                    @if (auth()->user()->hasRole('admin') ||
                            (auth()->user()->hasRole('trainer')))
                        {{-- Botón para entrenadores para crear rutinas nuevas --}}
                        <div class="flex pb-2">
                            <div class="overflow-x-auto mt-2 -mb-5 mx-5">
                                <a href="{{ route('routines.nueva') }}">
                                    <div
                                        class="inline-flex rounded bg-blue-600 px-2 py-2 text-xs font-medium text-white hover:bg-blue-500 delete-routine-btn align-items-center">
                                        <svg class="w-3 h-3 my-auto me-2 fill-white cursor-pointer" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 512 512">
                                            <path
                                                d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H48c-17.7 0-32 14.3-32 32s14.3 32 32 32H192V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H400c17.7 0 32-14.3 32-32s-14.3-32-32-32H256V80z" />
                                        </svg>
                                        Crear rutina
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endif
                @endauth
                {{-- Verifica si hay rutinas disponibles --}}
                @if ($routines)

                    {{-- Bucle para iterar sobre cada rutina --}}
                    <div class="flex flex-col lg:flex-row flex-wrap py-2 px-2 md:px-5 my-4 gap-4 justify-around">
                        @foreach ($routines as $routine)
                            <div class="basis-0 md:basis-5/12 grow">


                                {{-- Enlace para cada rutina --}}
                                <a href="{{ route('routine.show', ['id' => $routine->id]) }}">
                                    {{-- Contenedor de la rutina --}}

                                    <div class="max-w-7xl mx-auto ">
                                        {{-- Tarjeta de rutina con imagen de fondo y texto --}}
                                        <div class="flex flex-col text-end text-white p-6 max-h-60 overflow-hidden shadow-md rounded-sm
                                            h-screen bg-cover bg-center hover:grayscale"
                                            style="background-image: url('images/{{ $routine->img }}')">
                                            {{-- Información de la rutina --}}
                                            <div class="flex flex-col justify-end flex-grow">
                                                {{-- Nombre de la rutina --}}
                                                <h3
                                                    class="font-bold text-4xl drop-shadow-[0_1.2px_1.2px_rgba(0,0,0,0.8)] border-black truncate">
                                                    {{ $routine->name }}</h3>
                                                {{-- Descripción de la rutina --}}
                                                <p
                                                    class="font-extralightdrop-shadow-lg drop-shadow-[0_1.2px_1.2px_rgba(0,0,0,0.8)] truncate">
                                                    {{ $routine->description }}</p>
                                                {{-- Información del entrenador de la rutina --}}
                                                <p
                                                    class="font-thin text-xs drop-shadow-[0_1.2px_1.2px_rgba(0,0,0,0.8)] truncate">
                                                    Trainer:
                                                    {{ $routine->user->name }} {{ $routine->user->surname }}</p>
                                            </div>
                                        </div>
                                    </div>

                                </a>
                            </div>
                        @endforeach


                    </div>
                    {{ $routines->links() }}
                @else
                    {{-- Mensaje si no hay rutinas disponibles --}}
                    <p>No se encontraron rutinas.</p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
