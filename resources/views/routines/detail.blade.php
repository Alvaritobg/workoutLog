{{-- Vista Blade para mostrar las rutinas disponibles --}}
<script src="{{ asset('js/unpaidSubscription.js') }}"></script>
<x-app-layout>
    <div class="flex w-full">
        <div id="dynamicNotification"
            class="hidden flex w-full flex-row flex-wrap items-center py-4 px-4 md:px-5 my-4 mx-2 md:mx-5 gap-4">
            <svg class="w-10 h-20" xmlns="http://www.w3.org/2000/svg" id="Outline" viewBox="0 0 24 24" width="512"
                height="512"></svg>
            <p id="dynamicNotificationText" class="text-lg"></p>
        </div>
    </div>
    <div class="flex w-full">
        {{-- Modulo para mostrar mensajes de error y confirmación --}}
        <x-notification :status="session()"></x-notification>
    </div>
    {{-- Verifica si hay rutinas disponibles --}}
    @if ($routine)
        {{-- $routine --}}
        <div class="flex flex-col py-2 px-2 md:px-5 my-4 gap-4 justify-center">
            <div class="flex flex-col text-end text-white p-6 max-h-60 overflow-hidden shadow-md rounded-sm
                    h-screen bg-cover bg-center"
                style="background-image: url('/images/{{ $routine->img }}')">

            </div>

            <div class="divide-y divide-gray-100 border border-gray-100 bg-white p-5 shadow-md rounded-sm">

                <h2 class="text-2xl mb-3 font-black">{{ $routine->name }}</h2>

                @foreach ($routine->workouts as $workout)
                    <div class="border rounded my-2 p-2">
                        <h3 class="my-2 text-xl font-light">Día {{ $loop->iteration }}:</h3>
                        <table class="min-w-full divide-y-2 divide-gray-200 bg-white text-sm">
                            <thead class="ltr:text-left rtl:text-right">
                                <tr class="bg-gray-100">
                                    <th
                                        class="whitespace-nowrap px-4 py-4 font-medium text-gray-900 text-left max-w-20 overflow-hidden text-overflow-ellipsis">
                                        Ejercicio
                                    </th>
                                    <th
                                        class="whitespace-nowrap px-4 py-4 font-medium text-gray-900 text-left max-w-14">
                                        Series
                                    </th>
                                    <th
                                        class="whitespace-nowrap px-4 py-4 font-medium text-gray-900 text-left max-w-14">
                                        Rep
                                        min/max</th>
                                    <th class="whitespace-nowrap px-4 py-4 font-medium text-gray-900 text-left w-5">Ver
                                        ejercicio
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach ($workout->exercises as $exercise)
                                    <tr>
                                        <td
                                            class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 max-w-20 overflow-hidden text-overflow-ellipsis">
                                            {{ $exercise->name }}
                                        </td>
                                        <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 max-w-14">
                                            {{ $exercise->pivot->num_series }}
                                        </td>
                                        <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 max-w-14">
                                            {{ $exercise->min_reps_desired }} / {{ $exercise->max_reps_desired }}
                                        </td>
                                        <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 w-5">
                                            <a href="{{ $exercise->info }}" target="_blank">
                                                <svg xmlns="http://www.w3.org/2000/svg" id="Bold"
                                                    viewBox="0 0 24 24" class="w-5 h-5 fill-black">
                                                    <path
                                                        d="M12,0A12,12,0,1,0,24,12,12.013,12.013,0,0,0,12,0Zm0,22A10,10,0,1,1,22,12,10.011,10.011,0,0,1,12,22Z" />
                                                    <path
                                                        d="M12,10H11a1,1,0,0,0,0,2h1v6a1,1,0,0,0,2,0V12A2,2,0,0,0,12,10Z" />
                                                    <circle cx="12" cy="6.5" r="1.5" />
                                                </svg>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endforeach
            </div>



            <div class="flex gap-2 justify-end">
                {{-- Si eres un usuario | admin se muestra el boton para dessuscribirte a una rutina --}}
                @auth
                    @if (auth()->user()->hasRole('user'))
                        @if (auth()->user()->routine_id === $routine->id)
                            <form method="POST" action="{{ route('workouts.create') }}">
                                @csrf
                                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                <!-- Asumiendo que estos valores se generan dinámicamente -->
                                <input type="hidden" name="routine_id" value="{{ $routine->id }}">
                                <button type="submit" {{-- onclick="return confirm('¿Estás seguro de querer dejar esta rutina?');" --}}
                                    class="text-center inline-block rounded border border-green-600 px-12 py-3 text-sm font-medium text-green-600 hover:bg-green-600 hover:text-white focus:outline-none focus:ring active:bg-green-500">
                                    Registrar entrenamiento
                                </button>
                            </form>
                            <form method="post" action="{{ url('des-suscribir-usuario/') }}">
                                @csrf
                                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                <!-- Asumiendo que estos valores se generan dinámicamente -->
                                <input type="hidden" name="routine_id" value="{{ $routine->id }}">
                                <button type="submit"
                                    onclick="return confirm('¿Estás seguro de querer dejar esta rutina?');"
                                    class="text-center inline-block rounded border border-amber-600 px-12 py-3 text-sm font-medium bg-white text-amber-600 hover:bg-amber-600 hover:text-white focus:outline-none focus:ring active:bg-amber-500">
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
                {{-- Si eres un admin o el trainer que creo esa rutina se muestra el boton para editar / eliminar una rutina --}}
                @auth
                    @if (auth()->user()->hasRole('admin') ||
                            (auth()->user()->hasRole('trainer') && auth()->user()->id === $routine->user_id))
                        <a class="cursor-pointer max-h-11 text-center inline-block rounded border border-blue-600 px-12 py-3 text-sm font-medium text-blue-600 hover:bg-blue-600 hover:text-white focus:outline-none focus:ring active:bg-blue-500"
                            onclick="editarRutina('{{ auth()->user()->hasActivePaidSubscription() || auth()->user()->hasRole('admin') }}', '{{ route('rutinas.edit', ['id' => $routine->id]) }}')">
                            Editar @isset($routine->name)
                                {{ strtolower($routine->name) }}
                            @endisset
                        </a>
                        {{-- si tienes suscripcion activa puedes eliminar o no --}}
                        @if (auth()->user()->hasActivePaidSubscription())
                            <form action="{{ route('routines.destroy', ['id' => $routine->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('¿Estás seguro de querer eliminar esta rutina?');"
                                    class="max-h-11 text-center inline-block rounded border border-red-600 px-12 py-3 text-sm font-medium text-red-600 hover:bg-red-600 hover:text-white focus:outline-none focus:ring active:bg-blue-500">
                                    Eliminar @isset($routine->name)
                                        {{ strtolower($routine->name) }}
                                    @endisset
                                </button>
                            </form>
                        @else
                            <a href="#" onclick="eliminarRutina()"
                                class="max-h-11 text-center inline-block rounded border border-red-600 px-12 py-3 text-sm font-medium text-red-600 hover:bg-red-600 hover:text-white focus:outline-none focus:ring active:bg-blue-500">
                                Eliminar @isset($routine->name)
                                    {{ strtolower($routine->name) }}
                                @endisset
                            </a>
                        @endif
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
