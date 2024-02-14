{{-- Vista Blade para mostrar las rutinas disponibles --}}
<x-app-layout>
    {{-- Verifica si hay rutinas disponibles --}}
    @if ($routine)
        <div class="flex flex-col py-2 px-2 md:px-5 my-4 gap-4 justify-center">
            <div class="flex flex-col text-end text-white p-6 max-h-60 overflow-hidden shadow-md rounded-sm 
                    h-screen bg-cover bg-center"
                style="background-image: url('{{ $routine->img }}')">

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
            {{-- Mensajes de error o de confirmación --}}
            {{-- **Crear un modulo para esto con un popup que se pueda cerrar o se cierre a los x segundos --}}
            <div class="flex justify-end">
                @if (session('success'))
                    <div class="text-green-600  text-center flex basis-4/12 gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="max-w-5">
                            <path class="fill-green-600"
                                d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM369 209L241 337c-9.4 9.4-24.6 9.4-33.9 0l-64-64c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l47 47L335 175c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9z" />
                        </svg>{{ session('success') }}
                    </div>
                @endif
                @if (session('error'))
                    <div class="text-red-600  text-center flex basis-4/12 gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="max-w-5">
                            <path class="fill-red-600"
                                d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM369 209L241 337c-9.4 9.4-24.6 9.4-33.9 0l-64-64c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l47 47L335 175c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9z" />
                        </svg>
                        {{ session('error') }}
                    </div>
                @endif
            </div>
            {{-- Fin Mensajes de error o de confirmación --}}

            <div class="flex gap-2 justify-end">
                {{-- Si eres un usuario | admin se muestra el boton para suscribirte a una rutina --}}
                @auth
                    @if (auth()->user()->hasRole('user|admin'))
                        @if (auth()->user()->routine_id === $routine->id)
                            <form method="post"
                                action="{{ url('/des-suscribir-usuario/' . Auth::user()->id . '/rutina/' . $routine->id) }}">
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
                            <form method="post"
                                action="{{ url('/suscribir-usuario/' . Auth::user()->id . '/rutina/' . $routine->id) }}">
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
                {{-- Si eres un admin o un trainer se muestra el boton para editar una rutina --}}
                @auth
                    @if (auth()->user()->hasRole('admin') ||
                            (auth()->user()->hasRole('trainer') && auth()->user()->id === $routine->user_id))
                        <a class="text-center inline-block rounded border border-blue-600 px-12 py-3 text-sm font-medium text-blue-600 hover:bg-blue-600 hover:text-white focus:outline-none focus:ring active:bg-blue-500"
                            href="">
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
