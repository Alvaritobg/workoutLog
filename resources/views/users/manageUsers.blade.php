{{-- Vista Blade para mostrar las rutinas disponibles --}}
<x-app-layout>

    {{-- Slot para el encabezado de la página --}}
    <x-slot name="header">
        {{-- Título de la página --}}
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Panel de administración de usuarios
        </h2>
    </x-slot>

    {{-- Contenedor principal --}}
    {{-- Verifica si hay rutinas disponibles --}}
    @if ($users)

        <div class="overflow-x-auto my-7 mx-5 rounded-lg border border-gray-200 ">
            <table class="min-w-full divide-y-2 divide-gray-200 bg-white text-sm">
                <thead class="ltr:text-left rtl:text-right">
                    <tr class="bg-gray-100">
                        <th class="whitespace-nowrap px-4 py-4 font-medium text-gray-900 text-left">Nombre</th>
                        <th class="whitespace-nowrap px-4 py-4 font-medium text-gray-900 text-left">Email</th>
                        <th class="whitespace-nowrap px-4 py-4 font-medium text-gray-900 text-left">Rol</th>
                        <th class="whitespace-nowrap px-4 py-4 font-medium text-gray-900 text-left">Verificado</th>
                        <th class="px-4 py-2"></th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-200">
                    @foreach ($users as $user)
                        <tr>
                            <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">
                                {{ $user->name . ' ' . $user->surname }}</td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ $user->email }}</td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700">
                                {{ implode(', ', $user->roles->pluck('name')->toArray()) }}</td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700">
                                @if ($user->email_verified_at != null)
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="max-w-5">
                                        <path class="fill-green-600"
                                            d="M256 48a208 208 0 1 1 0 416 208 208 0 1 1 0-416zm0 464A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM369 209c9.4-9.4 9.4-24.6 0-33.9s-24.6-9.4-33.9 0l-111 111-47-47c-9.4-9.4-24.6-9.4-33.9 0s-9.4 24.6 0 33.9l64 64c9.4 9.4 24.6 9.4 33.9 0L369 209z" />
                                    </svg>
                                @else
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="max-w-5">
                                        <path class="fill-red-600"
                                            d="M256 48a208 208 0 1 1 0 416 208 208 0 1 1 0-416zm0 464A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM175 175c-9.4 9.4-9.4 24.6 0 33.9l47 47-47 47c-9.4 9.4-9.4 24.6 0 33.9s24.6 9.4 33.9 0l47-47 47 47c9.4 9.4 24.6 9.4 33.9 0s9.4-24.6 0-33.9l-47-47 47-47c9.4-9.4 9.4-24.6 0-33.9s-24.6-9.4-33.9 0l-47 47-47-47c-9.4-9.4-24.6-9.4-33.9 0z" />
                                    </svg>
                                @endif

                            </td>
                            <td class="whitespace-nowrap px-4 py-2">

                                <!-- Botón de Eliminación -->
                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        onclick="return confirm('¿Estás seguro de querer eliminar este usuario?');"
                                        class="inline-block rounded bg-red-600 px-4 py-2 text-xs font-medium text-white hover:bg-red-500">
                                        Eliminar
                                    </button>
                                </form>
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
        <p>No hay usuarios</p>
    @endif

</x-app-layout>
