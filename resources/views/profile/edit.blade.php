<!-- VISTA PARA /profile -->
<x-app-layout>
    <div class="flex w-full">
        {{-- Modulo para mostrar mensajes de error y confirmación --}}
        <x-notification :status="session()"></x-notification>
    </div>
    <div class="py-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 my-6">
            <div class="p-4 mb-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <!-- Incluye otra vista dentro de esta, en este caso para editar la info personal del usuario -->
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>
            {{--  Pagar subscripcion si eres entrenador --}}
            @auth
                @if (auth()->user()->hasRole('trainer'))
                    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg my-6">
                        <div class="max-w-xl">
                            @include('profile.partials.trainer-subscription')
                        </div>
                    </div>
                @endif
            @endauth

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg my-6">
                <div class="max-w-xl">
                    <!-- Incluye otra vista dentro de esta, en este caso para editar contraseña de usuario -->
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg my-6">
                <div class="max-w-xl">
                    <!-- Incluye otra vista dentro de esta, en este caso para eliminar la cuenta de usuario-->
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
