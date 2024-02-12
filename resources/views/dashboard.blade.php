<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot> --}}

    <div class="py-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="flex flex-col lg:flex-row flex-wrap py-2 px-2 md:px-5 my-4 gap-4 justify-around">
                    @auth
                        @if (auth()->user()->hasRole('user'))
                            {{-- PRIMERA OPCIÓN (SI SE TIENE UNA RUTINA ASIGNADA) --}}
                            <div class="basis-0 md:basis-5/12 grow">
                                {{-- Asignación de la imagen de la rutina a una variable PHP --}}
                                @php
                                    //$routineImg = $routine->img;
                                @endphp

                                {{-- Enlace para cada rutina --}}
                                <a href="#">
                                    {{-- Contenedor de la rutina --}}

                                    <div class="max-w-7xl mx-auto ">
                                        {{-- Tarjeta de rutina con imagen de fondo y texto --}}
                                        <div class="flex flex-col text-end text-white p-6 max-h-60 overflow-hidden shadow-md rounded-sm   
                                        h-screen bg-cover bg-center hover:grayscale"
                                            style="background-image: url('{{ asset('img/fuerza.jpg') }}')">
                                            {{-- Información de la rutina --}}
                                            <div class="flex flex-col justify-end flex-grow">
                                                {{-- Nombre de la rutina --}}
                                                <h3
                                                    class="font-bold text-4xl drop-shadow-[0_1.2px_1.2px_rgba(0,0,0,0.8)] border-black">
                                                    Mi rutina</h3>
                                                {{-- Descripción de la rutina --}}
                                                <p
                                                    class="font-extralightdrop-shadow-lg drop-shadow-[0_1.2px_1.2px_rgba(0,0,0,0.8)]">
                                                    Nombre de la rutina</p>

                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endif
                    @endauth
                    {{-- SEGUNDA OPCIÓN --}}
                    <div class="basis-0 md:basis-5/12 grow">
                        {{-- Asignación de la imagen de la rutina a una variable PHP --}}
                        @php
                            //$routineImg = $routine->img;
                        @endphp

                        {{-- Enlace para cada rutina --}}
                        <a href="{{ 'rutinas' }}">
                            {{-- Contenedor de la rutina --}}

                            <div class="max-w-7xl mx-auto ">
                                {{-- Tarjeta de rutina con imagen de fondo y texto --}}
                                <div class="flex flex-col text-end text-white p-6 max-h-60 overflow-hidden shadow-md rounded-sm   
                                        h-screen bg-cover bg-center hover:grayscale"
                                    style="background-image: url('{{ asset('img/pesas.jpg') }}')">
                                    {{-- Información de la rutina --}}
                                    <div class="flex flex-col justify-end flex-grow">
                                        {{-- Nombre de la rutina --}}
                                        <h3
                                            class="font-bold text-4xl drop-shadow-[0_1.2px_1.2px_rgba(0,0,0,0.8)] border-black">
                                            Rutinas</h3>
                                        {{-- Descripción de la rutina --}}
                                        <p
                                            class="font-extralightdrop-shadow-lg drop-shadow-[0_1.2px_1.2px_rgba(0,0,0,0.8)]">
                                            Seleccione su rutina de entrenamiento</p>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    {{-- TERCERA OPCION --}}
                    <div class="basis-0 md:basis-5/12 grow">
                        {{-- Asignación de la imagen de la rutina a una variable PHP --}}
                        @php
                            //$routineImg = $routine->img;
                        @endphp

                        {{-- Enlace para cada rutina --}}
                        <a href="#">
                            {{-- Contenedor de la rutina --}}

                            <div class="max-w-7xl mx-auto ">
                                {{-- Tarjeta de rutina con imagen de fondo y texto --}}
                                <div class="flex flex-col text-end text-white p-6 max-h-60 overflow-hidden shadow-md rounded-sm   
                                        h-screen bg-cover bg-center hover:grayscale"
                                    style="background-image: url('{{ asset('img/estadisticas.jpg') }}')">
                                    {{-- Información de la rutina --}}
                                    <div class="flex flex-col justify-end flex-grow">
                                        {{-- Nombre de la rutina --}}
                                        <h3
                                            class="font-bold text-4xl drop-shadow-[0_1.2px_1.2px_rgba(0,0,0,0.8)] border-black">
                                            Estadísticas</h3>
                                        {{-- Descripción de la rutina --}}
                                        <p
                                            class="font-extralightdrop-shadow-lg drop-shadow-[0_1.2px_1.2px_rgba(0,0,0,0.8)]">
                                            Consulte sus progresiones</p>

                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    {{-- CUARTA OPCION --}}
                    <div class="basis-0 md:basis-5/12 grow">
                        {{-- Asignación de la imagen de la rutina a una variable PHP --}}
                        @php
                            //$routineImg = $routine->img;
                        @endphp

                        {{-- Enlace para cada rutina --}}
                        <a href="#">
                            {{-- Contenedor de la rutina --}}

                            <div class="max-w-7xl mx-auto ">
                                {{-- Tarjeta de rutina con imagen de fondo y texto --}}
                                <div class="flex flex-col text-end text-white p-6 max-h-60 overflow-hidden shadow-md rounded-sm   
                                        h-screen bg-cover bg-center hover:grayscale"
                                    style="background-image: url('{{ asset('img/perfil.jpg') }}')">
                                    {{-- Información de la rutina --}}
                                    <div class="flex flex-col justify-end flex-grow">
                                        {{-- Nombre de la rutina --}}
                                        <h3
                                            class="font-bold text-4xl drop-shadow-[0_1.2px_1.2px_rgba(0,0,0,0.8)] border-black">
                                            Mi perfil</h3>
                                        {{-- Descripción de la rutina --}}
                                        <p
                                            class="font-extralightdrop-shadow-lg drop-shadow-[0_1.2px_1.2px_rgba(0,0,0,0.8)]">
                                            Gestione y modifique sus datos de perfil</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    @auth
                        @if (auth()->user()->hasRole('trainer'))
                            {{-- QUINTA OPCION --}}
                            <div class="basis-0 md:basis-5/12 grow">
                                {{-- Asignación de la imagen de la rutina a una variable PHP --}}
                                @php
                                    //$routineImg = $routine->img;
                                @endphp

                                {{-- Enlace para cada rutina --}}
                                <a href="#">
                                    {{-- Contenedor de la rutina --}}

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
                                                    Mis rutinas (si eres entrenador)</h3>
                                                {{-- Descripción de la rutina --}}
                                                <p
                                                    class="font-extralightdrop-shadow-lg drop-shadow-[0_1.2px_1.2px_rgba(0,0,0,0.8)]">
                                                    Gestione y modifique sus rutinas</p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endif
                    @endauth
                    @auth
                        @if (auth()->user()->hasRole('admin'))
                            <!-- Elemento visible solo para administradores -->
                            {{-- SEXTA OPCION --}}
                            <div class="basis-0 md:basis-5/12 grow">
                                {{-- Asignación de la imagen de la rutina a una variable PHP --}}
                                @php
                                    //$routineImg = $routine->img;
                                @endphp

                                {{-- Enlace para cada rutina --}}
                                <a href="#">
                                    {{-- Contenedor de la rutina --}}

                                    <div class="max-w-7xl mx-auto ">
                                        {{-- Tarjeta de rutina con imagen de fondo y texto --}}
                                        <div class="flex flex-col text-end text-white p-6 max-h-60 overflow-hidden shadow-md rounded-sm   
                                        h-screen bg-cover bg-center hover:grayscale"
                                            style="background-image: url('{{ asset('img/gestion.jpg') }}')">
                                            {{-- Información de la rutina --}}
                                            <div class="flex flex-col justify-end flex-grow">
                                                {{-- Nombre de la rutina --}}
                                                <h3
                                                    class="font-bold text-4xl drop-shadow-[0_1.2px_1.2px_rgba(0,0,0,0.8)] border-black">
                                                    Gestión de usuarios (Sólo Admin)</h3>
                                                {{-- Descripción de la rutina --}}
                                                <p
                                                    class="font-extralightdrop-shadow-lg drop-shadow-[0_1.2px_1.2px_rgba(0,0,0,0.8)]">
                                                    Gestione y modifique sus datos de perfil</p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endif
                    @endauth
                    {{-- FIN OPCIONES --}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
