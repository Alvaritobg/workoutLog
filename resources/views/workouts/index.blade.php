
<!-- ESTO ES UNA PRUEBA, ELIMINAR/EDITAR -->
<x-app-layout>
<x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ejercicios') }} {{-- Título de la página --}}
        </h2>
    </x-slot>
@if($workout)
    <div class="container">
        <h1>Detalles del Entrenamiento</h1>
        {{$workout}}
        <div>
            <h2>{{ $workout->nombre }}</h2>
            <p><strong>ID del Entrenamiento: </strong>{{ $workout->id }}</p>
            <p><strong>Nombre del Entrenamiento: </strong>{{ $workout->name }}</p>
        </div>
    </div>
@else
    <div class="container">
        <p>Entrenamiento no encontrado.</p>
    </div>
@endif


</x-app-layout>
