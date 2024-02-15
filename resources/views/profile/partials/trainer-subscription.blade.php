<!-- Vista para pagar la suscripción de entrenador -->
<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Pagar la subscripción de entrenador') }}
        </h2>
        <p>La subscripción es mensual con posibilidad de autorenovarse.</p>
    </header>
    @php
        $latestSubscription = auth()->user()->subscriptions()->latest('end_date')->first();
    @endphp

    @if (auth()->user()->hasActivePaidSubscription())
        <p class="italic p-3 border-dashed rounded-lg border-2 border-green-600 bg-green-50 text-center w-72">Su
            subscripción está activa hasta el:
            <b>
                {{ \Carbon\Carbon::parse($latestSubscription->end_date)->format('d-m-Y') }}.<br>
                {{ auth()->user()->subscriptions()->latest('end_date')->first()->renew == 1 ? 'Se renovara automaticamente.' : '' }}

        </p>
        @if (auth()->user()->subscriptions()->latest('end_date')->first()->renew)
            <form action="{{ route('subscription.disableRenew') }}"method="POST">
                @csrf
                {{-- $latestSubscription --}}
                <button type="submit"
                    onclick="return confirm('¿Estás seguro de querer cancelar la renovación automática?');"
                    class="mt-4 inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:ring focus:ring-red-200 active:bg-red-600 transition ease-in-out duration-150">
                    Cancelar renovación automática
                </button>
            </form>
        @endif
    @else
        <form action="{{ route('subscriptions.store') }}" method="POST" class="flex gap-4 flex-wrap">
            @csrf
            @method('post')
            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
            <div class="mr-2">
                <button type="submit" onclick="return confirm('¿Estás seguro de querer pagar la subscripción?');"
                    class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    Pagar subscripción
                </button>
            </div>

            <div class="pt-2">
                <input type="checkbox" name="auto_renew" id="auto_renew" value="1" class="mr-1">
                <label for="auto_renew"><i>Renovar automáticamente:</i></label>
            </div>
        </form>
    @endif
    @if (session('success'))
        <div class="italic text-green-600">{{ session('success') }}</div>
    @elseif(session('error'))
        <div class="italic text-red-600">{{ session('error') }}</div>
    @endif
</section>
