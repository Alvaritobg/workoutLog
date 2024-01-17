<!-- Vista para editar la contraseña del usuario -->
<section>
    <!-- Encabezado de la sección -->
    <header>
        <!-- Título de la sección -->
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Cambiar contraseña') }}
        </h2>

        <!-- Instrucción o recomendación para el usuario -->
        <p class="mt-1 text-sm text-gray-600">
            {{ __('Asegurese de usar una contraseña segura.') }}
        </p>
    </header>

    <!-- Formulario de actualización de contraseña -->
    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf <!-- Token CSRF para proteger el formulario -->
        @method('put') <!-- Método HTTP para la solicitud -->

        <!-- Campo para la contraseña actual -->
        <div>
            <x-input-label for="update_password_current_password" :value="__('Contraseña actual')" />
            <x-text-input id="update_password_current_password" name="current_password" type="password" class="mt-1 block w-full" autocomplete="current-password" />
            <!-- Mensajes de error para este campo -->
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <!-- Campo para la nueva contraseña -->
        <div>
            <x-input-label for="update_password_password" :value="__('Nueva contraseña')" />
            <x-text-input id="update_password_password" name="password" type="password" class="mt-1 block w-full" autocomplete="new-password" />
            <!-- Mensajes de error para este campo -->
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <!-- Campo para confirmar la nueva contraseña -->
        <div>
            <x-input-label for="update_password_password_confirmation" :value="__('Confirme contraseña')" />
            <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" autocomplete="new-password" />
            <!-- Mensajes de error para este campo -->
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Botón para guardar los cambios -->
        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Guardar') }}</x-primary-button>
            
            <!-- Mensaje de confirmación de actualización exitosa -->
            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Guardado.') }}</p>
            @endif
        </div>
    </form>
</section>

