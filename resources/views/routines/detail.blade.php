{{-- Vista Blade para mostrar las rutinas disponibles --}}
<x-app-layout>
    {{-- Verifica si hay rutinas disponibles --}}
    @if ($routine)
        <div class="flex flex-col py-2 px-2 md:px-5 my-4 gap-4 justify-center">
            <div
                class="flex flex-col text-end text-white p-6 max-h-60 overflow-hidden shadow-md rounded-sm 
                    bg-[url(https://images.unsplash.com/photo-1534438327276-14e5300c3a48?q=80&w=1470&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D)]
                    h-screen bg-cover bg-center">

            </div>

            <div class="divide-y divide-gray-100 rounded-sm border border-gray-100 bg-white p-5">

                <div class="flow-root">
                    <dl class="-my-3 divide-y divide-gray-100 text-sm">

                        <div class="grid grid-cols-1 gap-1 py-3 sm:grid-cols-3 sm:gap-4">
                            <dt class="font-medium text-gray-900">Nombre:</dt>
                            <dd class="text-gray-700 sm:col-span-2">
                                @isset($routine->name)
                                    <p>{{ $routine->name }}</p>
                                @endisset
                            </dd>
                        </div>

                        <div class="grid grid-cols-1 gap-1 py-3 sm:grid-cols-3 sm:gap-4">
                            <dt class="font-medium text-gray-900">Descripción:</dt>
                            <dd class="text-gray-700 sm:col-span-2">
                                @isset($routine->description)
                                    <p>{{ $routine->description }}</p>
                                @endisset
                            </dd>
                        </div>

                        <div class="grid grid-cols-1 gap-1 py-3 sm:grid-cols-3 sm:gap-4">
                            <dt class="font-medium text-gray-900">Duración:</dt>
                            <dd class="text-gray-700 sm:col-span-2">
                                @isset($routine->duration)
                                    <p>{{ $routine->duration }} semanas.</p>
                                @endisset
                            </dd>
                        </div>

                        <div class="grid grid-cols-1 gap-1 py-3 sm:grid-cols-3 sm:gap-4">
                            <dt class="font-medium text-gray-900">Días:</dt>
                            <dd class="text-gray-700 sm:col-span-2">
                                @isset($routine->days)
                                    <p>{{ $routine->days }} días a la semana.</p>
                                @endisset
                            </dd>
                        </div>

                        <div class="grid grid-cols-1 gap-1 py-3 sm:grid-cols-3 sm:gap-4">
                            <dt class="font-medium text-gray-900">Creada por:</dt>
                            <dd class="text-gray-700 sm:col-span-2">
                                @isset($routine->user->name)
                                    <p>{{ $routine->user->name }}</p> {{-- poner enlace al perfil del entrenador --}}
                                @endisset
                            </dd>
                        </div>
                    </dl>
                </div>
            </div>
            <div class="flex gap-2 justify-end">
                <a class="text-center inline-block rounded border border-green-600 px-12 py-3 text-sm font-medium text-green-600 hover:bg-green-600 hover:text-white focus:outline-none focus:ring active:bg-green-500"
                    href="#pone enlace que active la rutina para este usuario">
                    Elegir @isset($routine->name)
                        {{ strtolower($routine->name) }}
                    @endisset
                </a>
                <a class="text-center inline-block rounded border border-blue-600 px-12 py-3 text-sm font-medium text-blue-600 hover:bg-blue-600 hover:text-white focus:outline-none focus:ring active:bg-blue-500"
                    href="#pone enlace que active la rutina para este usuario">
                    Editar @isset($routine->name)
                        {{ strtolower($routine->name) }}
                    @endisset
                </a>
            </div>
        </div>
    @else
        {{-- Mensaje si no hay rutinas disponibles --}}
        <p>Rutina inexistente</p>
    @endif

</x-app-layout>
