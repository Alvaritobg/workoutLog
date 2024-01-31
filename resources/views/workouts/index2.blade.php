
<!-- ESTO ES UNA PRUEBA, ELIMINAR/EDITAR -->
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
                {{-- En resources/views/workouts/show.blade.php --}}

                @extends('layouts.app')

                @section('content')
                    <h1>Ejercicios en Entrenamiento</h1>
                    @if ($workout)
                        <ul>
                            @foreach ($workout->exercises as $exercise)
                                <li>{{ $exercise->name }}</li>
                            @endforeach
                        </ul>
                    @else
                        <p>No se encontraron ejercicios para este entrenamiento.</p>
                    @endif
                @endsection

                </div>
            </div>
        </div>
    </div>

</x-app-layout>