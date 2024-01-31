{{-- Vista Blade para mostrar las rutinas disponibles --}}
<x-app-layout>

    {{-- Slot para el encabezado de la página --}}
    <x-slot name="header">
        {{-- Título de la página --}}
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $routine->name ? $routine->name : 'Rutina sin nombre' }}
        </h2>
        {{-- Subtítulo o descripción adicional --}}
        <p>{{ $routine->description ? $routine->description : 'Rutina sin nombre' }}</p>
    </x-slot>

    {{-- Contenedor principal --}}


    {{-- Verifica si hay rutinas disponibles --}}
    @if ($routine)

        <div class="flex flex-col py-2 px-2 md:px-5 my-4 gap-4 justify-center">
            <div class="divide-y divide-gray-100 rounded-sm border border-gray-100 bg-white p-5">
                <div class="flow-root">
                    <dl class="-my-3 divide-y divide-gray-100 text-sm">
                        <div class="grid grid-cols-1 gap-1 py-3 sm:grid-cols-3 sm:gap-4">
                            <dt class="font-medium text-gray-900">Title</dt>
                            <dd class="text-gray-700 sm:col-span-2">Mr</dd>
                        </div>

                        <div class="grid grid-cols-1 gap-1 py-3 sm:grid-cols-3 sm:gap-4">
                            <dt class="font-medium text-gray-900">Name</dt>
                            <dd class="text-gray-700 sm:col-span-2">John Frusciante</dd>
                        </div>

                        <div class="grid grid-cols-1 gap-1 py-3 sm:grid-cols-3 sm:gap-4">
                            <dt class="font-medium text-gray-900">Occupation</dt>
                            <dd class="text-gray-700 sm:col-span-2">Guitarist</dd>
                        </div>

                        <div class="grid grid-cols-1 gap-1 py-3 sm:grid-cols-3 sm:gap-4">
                            <dt class="font-medium text-gray-900">Salary</dt>
                            <dd class="text-gray-700 sm:col-span-2">$1,000,000+</dd>
                        </div>

                        <div class="grid grid-cols-1 gap-1 py-3 sm:grid-cols-3 sm:gap-4">
                            <dt class="font-medium text-gray-900">Bio</dt>
                            <dd class="text-gray-700 sm:col-span-2">
                                Lorem ipsum dolor, sit amet consectetur adipisicing elit. Et facilis debitis
                                explicabo
                                doloremque impedit nesciunt dolorem facere, dolor quasi veritatis quia fugit aperiam
                                aspernatur neque molestiae labore aliquam soluta architecto?
                            </dd>
                        </div>
                    </dl>
                </div>


            </div>




        </div>


        @foreach ($routine as $r)
            {{ $r }}
        @endforeach
    @else
        {{-- Mensaje si no hay rutinas disponibles --}}
        <p>Rutina inexistente</p>
    @endif

</x-app-layout>
