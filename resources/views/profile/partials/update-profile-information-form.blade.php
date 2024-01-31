<!-- Vista para editar datos personales del usuario -->
<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Información de perfil') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Actualice sus datos y su email.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')
        <!-- NOMBRE -->
        <div>
            <x-input-label for="name" :value="__('Nombre')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)"  required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>
        <!-- APELLIDOS -->
        <div>
            <x-input-label for="surname" :value="__('Apellidos')" />
            <x-text-input id="surname" name="surname" type="text" class="mt-1 block w-full" :value="old('surname', $user->surname)" required autofocus autocomplete="surname" />
            <x-input-error class="mt-2" :messages="$errors->get('surname')" />
        </div>
        <!-- FECHA DE NACIMIENTO -->
        <div>
            <x-input-label for="date_of_birth" :value="__('Fecha de nacimiento')" />
            <x-text-input id="date_of_birth" name="date_of_birth" type="date" class="mt-1 block w-full" :value="old('date_of_birth', $user->date_of_birth)" required autofocus autocomplete="date_of_birth" />
            <x-input-error class="mt-2" :messages="$errors->get('date_of_birth')" />
        </div>
        <!-- PESO -->
        <div>
            <x-input-label for="weight" :value="__('Peso (kg)')" />
            <x-text-input id="weight" name="weight" type="number" class="mt-1 block w-full" :value="old('weight', $user->weight)" autofocus autocomplete="weight" />
            <x-input-error class="mt-2" :messages="$errors->get('weight')" />
        </div>
        <!-- EMAIL -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="email" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />
            <!-- SE MUESTRA SI EL EMAIL NO ESTA VERIFICADO (EN PRINCIPIO NO TENGO HABILITADA ESTA OPCIÓN) -->
            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Su email está sin verificar.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Haga click aquí para reenviar la verificación de email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('Un nuevo enlace de verificación fue enviado a su email.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>
        <!-- BTN DE GUARDADO -->
        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Guardar') }}</x-primary-button>
            <!-- SI SE GUARDA CORRECTAMENTE MUESTRA 'GUARDADO' -->
            @if (session('status') === 'profile-updated')
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
