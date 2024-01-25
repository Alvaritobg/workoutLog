{{-- 
  Vista de Índice de Ejercicios.
  
  Esta vista muestra una lista de ejercicios. Cada ejercicio se presenta con su nombre y descripción.
  Se utiliza el layout 'app', y se define un slot para el encabezado de la página.

  @extends 'layouts.app' (Utiliza el layout principal de la aplicación)

  Variables Disponibles:
  @var \Illuminate\Database\Eloquent\Collection|\App\Models\Exercise[] $exercises Colección de ejercicios
--}}

{{-- Utiliza el layout 'app' --}}
<x-app-layout>

    {{-- Slot para el encabezado de la página --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ejercicios') }} {{-- Título de la página --}}
        </h2>
    </x-slot>

    {{-- Contenedor principal --}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{-- Lista de ejercicios --}}
                    <ul class="list-disc list-inside">
                        {{-- Itera sobre cada ejercicio y muestra su nombre y descripción --}}
                        @foreach ($exercises as $exercise)
                            <li>{{ $exercise->name }} - {{ $exercise->description }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>

 