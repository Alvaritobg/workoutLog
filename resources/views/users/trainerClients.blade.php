{{-- Vista Blade para mostrar las rutinas disponibles --}}
<x-app-layout>

    {{-- Slot para el encabezado de la página --}}
    <x-slot name="header">
        {{-- Título de la página --}}
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Panel de seguimiento para los usuarios de tus rutinas
        </h2>
    </x-slot>


    @if ($users)

        <div class="overflow-x-auto my-7 mx-5 rounded-lg border border-gray-200 ">
            <table class="min-w-full divide-y-2 divide-gray-200 bg-white text-sm">
                <thead class="ltr:text-left rtl:text-right">
                    <tr class="bg-gray-100">
                        <th class="whitespace-nowrap px-4 py-4 font-medium text-gray-900 text-left">Nombre</th>
                        <th class="whitespace-nowrap px-4 py-4 font-medium text-gray-900 text-left">Edad</th>
                        <th class="whitespace-nowrap px-4 py-4 font-medium text-gray-900 text-left">Peso</th>
                        <th class="whitespace-nowrap px-4 py-4 font-medium text-gray-900 text-left">Rutina</th>
                        <th class="px-4 py-2">Acciones</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-200">
                    @foreach ($users as $user)
                        <tr>
                            <td class="whitespace-nowrap px-4 py-4 font-medium text-gray-900">
                                {{ $user->name . ' ' . $user->surname }}</td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ $user->getAge() }}</td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700">
                                {{ $user->weight }}kg</td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700">
                                {{ $user->routines->name }}
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 flex gap-3 justify-center items-center">
                                <a href="/administrar-clientes/ver-entrenamientos/{{ $user->id }}">
                                    <div
                                        class="cursor-pointer rounded  px-4 text-xs font-medium text-white  bg-green-700 hover:bg-green-700/80 focus:ring-4 focus:outline-none  py-2.5 text-center inline-flex items-centerme-2 ">

                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 me-2 fill-white"
                                            viewBox="0 0 512 512" class="max-w-5">
                                            <path
                                                d="M64 64c0-17.7-14.3-32-32-32S0 46.3 0 64V400c0 44.2 35.8 80 80 80H480c17.7 0 32-14.3 32-32s-14.3-32-32-32H80c-8.8 0-16-7.2-16-16V64zm406.6 86.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L320 210.7l-57.4-57.4c-12.5-12.5-32.8-12.5-45.3 0l-112 112c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L240 221.3l57.4 57.4c12.5 12.5 32.8 12.5 45.3 0l128-128z" />
                                        </svg>
                                        Ver entrenamientos
                                    </div>
                                </a>

                                <a href="mailto:{{ $user->email }}" target="_blank">
                                    <button type="submit "
                                        class=" rounded  px-4 text-xs font-medium text-white  bg-[#3b5998] hover:bg-[#3b5998]/90 focus:ring-4 focus:outline-none  py-2.5 text-center inline-flex items-center  me-2 ">

                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 me-2"
                                            viewBox="0 0 512 512">
                                            <path
                                                d="M64 112c-8.8 0-16 7.2-16 16v22.1L220.5 291.7c20.7 17 50.4 17 71.1 0L464 150.1V128c0-8.8-7.2-16-16-16H64zM48 212.2V384c0 8.8 7.2 16 16 16H448c8.8 0 16-7.2 16-16V212.2L322 328.8c-38.4 31.5-93.7 31.5-132 0L48 212.2zM0 128C0 92.7 28.7 64 64 64H448c35.3 0 64 28.7 64 64V384c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V128z" />
                                        </svg>
                                        Contactar
                                    </button>
                                </a>


                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
        {{-- Mostrar enlaces de paginación --}}
        {{ $users->links('vendor.pagination.tailwind') }}
    @else
        {{-- Mensaje si no hay rutinas disponibles --}}
        <p>No hay usuarios usando tus rutinas.</p>
    @endif

</x-app-layout>
