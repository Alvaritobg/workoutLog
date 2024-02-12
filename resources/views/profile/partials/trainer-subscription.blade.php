<!-- Vista para elimnar la cuenta de usuario -->
<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Pagar la subscipción de entrenador') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Introduzca su contraseña y pulse en pagar subscripción. Una vez pagada tendrá un més de servicio.') }}
        </p>
    </header>
    <!-- Botón para eliminar cuenta -->
    <x-primary-button x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-pay-subscription')">{{ __('Pagar subscripción') }}</x-primary-button>
    <!--  Modal con advertencias al pulsar en eliminar -->
    <x-modal name="confirm-pay-subscription" focusable>
        <form method="post" action="" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-medium text-gray-900">
                {{ __('Pagar la subscripción') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                {{ __('Una vez aceptado se realizara el cargo') }}
            </p>
            <!-- Input para pedir la contraseña antes de pagar-->
            <div class="mt-6">
                <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />

                <x-text-input id="password" name="password" type="password" class="mt-1 block w-3/4"
                    placeholder="{{ __('Contraseña') }}" />
                <!-- Muestra un posible error -->
                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>
            <!-- Boton para confirmar o cancelar la eliminación de la cuenta -->
            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancelar') }}
                </x-secondary-button>

                <x-danger-button class="ms-3">
                    {{ __('Pagar subscripción.') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>
