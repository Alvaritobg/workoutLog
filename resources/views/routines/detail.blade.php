{{-- Vista Blade para mostrar las rutinas disponibles --}}
<x-app-layout>
    <div class="flex w-full">
        {{-- Modulo para mostrar mensajes de error y confirmación --}}
        <x-notification :status="session()"></x-notification>
    </div>
    {{-- Verifica si hay rutinas disponibles --}}
    @if ($routine)
        <div class="flex flex-col py-2 px-2 md:px-5 my-4 gap-4 justify-center">
            <div class="flex flex-col text-end text-white p-6 max-h-60 overflow-hidden shadow-md rounded-sm 
                    h-screen bg-cover bg-center"
                style="background-image: url('/images/{{ $routine->img }}')">

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
                                    <p>{{ $routine->user->name }}</p>
                                @endisset
                            </dd>
                        </div>
                    </dl>
                </div>
            </div>

            <div class="flex gap-2 justify-end">
                {{-- Si eres un usuario | admin se muestra el boton para dessuscribirte a una rutina --}}
                @auth
                    @if (auth()->user()->hasRole('user|admin'))
                        @if (auth()->user()->routine_id === $routine->id)
                            <form method="post" action="{{ url('des-suscribir-usuario/') }}">
                                @csrf
                                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                <!-- Asumiendo que estos valores se generan dinámicamente -->
                                <input type="hidden" name="routine_id" value="{{ $routine->id }}">
                                <button type="submit"
                                    class="text-center inline-block rounded border border-green-600 px-12 py-3 text-sm font-medium text-green-600 hover:bg-green-600 hover:text-white focus:outline-none focus:ring active:bg-green-500">
                                    Dejar @isset($routine->name)
                                        {{ strtolower($routine->name) }}
                                    @endisset
                                </button>
                            </form>
                        @elseif(auth()->user()->routine_id === null)
                            <form method="post" action="{{ url('suscribir-usuario/') }}">
                                @csrf
                                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                <!-- Asumiendo que estos valores se generan dinámicamente -->
                                <input type="hidden" name="routine_id" value="{{ $routine->id }}">
                                <button type="submit"
                                    class="text-center inline-block rounded border border-green-600 px-12 py-3 text-sm font-medium text-green-600 hover:bg-green-600 hover:text-white focus:outline-none focus:ring active:bg-green-500">
                                    Elegir @isset($routine->name)
                                        {{ strtolower($routine->name) }}
                                    @endisset
                                </button>
                            </form>
                        @endif
                    @endif
                @endauth
                {{--  --}}
                {{-- Si eres un admin o el trainer que creo esa rutina se muestra el boton para editar una rutina --}}
                @auth
                    @if (auth()->user()->hasRole('admin') ||
                            (auth()->user()->hasRole('trainer') && auth()->user()->id === $routine->user_id))
                        <a class="text-center inline-block rounded border border-blue-600 px-12 py-3 text-sm font-medium text-blue-600 hover:bg-blue-600 hover:text-white focus:outline-none focus:ring active:bg-blue-500"
                            href="{{ route('rutinas.edit', ['id' => $routine->id]) }}">
                            Editar @isset($routine->name)
                                {{ strtolower($routine->name) }}
                            @endisset
                        </a>
                    @endif
                @endauth
                {{--  --}}
            </div>
        </div>
    @else
        {{-- Mensaje si no hay rutinas disponibles --}}
        <p>Rutina inexistente</p>
    @endif

</x-app-layout>
