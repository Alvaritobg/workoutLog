<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Subscription;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

/**
 * Controlador para la gestión de suscripciones de usuarios.
 *
 * Este controlador maneja la creación de nuevas suscripciones para los usuarios
 * y la desactivación de la renovación automática de suscripciones.
 */
class SubscriptionController extends Controller
{
    /**
     * Crea una nueva suscripción para un usuario.
     *
     * @param Request $request Datos de la solicitud incluyendo el ID del usuario y el estado de auto renovación.
     * @return \Illuminate\Http\RedirectResponse Redirige a la página anterior con un mensaje de éxito o error.
     */
    public function store(Request $request)
    {
        // Validación de la solicitud
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'auto_renew' => 'sometimes|boolean',
        ]);

        try {
            // Inicia una transacción de base de datos
            DB::beginTransaction();

            // Crea y configura la nueva suscripción
            $subscription = new Subscription();
            $subscription->user_id = $request->user_id;
            $subscription->renew = $request->has('auto_renew');
            $subscription->paid = true;
            $subscription->start_date = now();
            $subscription->end_date = now()->addMonth(); // Suscripción de 1 mes
            $subscription->save();

            // Si todo sale bien, confirma la transacción
            DB::commit();

            return redirect()->back()->with('success', 'Suscripción realizada con éxito.');
        } catch (Exception $e) {
            // Si algo sale mal, revierte la transacción
            DB::rollBack();

            // Redirige con un mensaje de error
            return redirect()->back()->with('error', 'Hubo un problema al realizar la suscripción.');
        }
    }

    /**
     * Desactiva la renovación automática de la suscripción más reciente del usuario autenticado.
     *
     * @return \Illuminate\Http\RedirectResponse Redirige a la página anterior con un mensaje de éxito o error.
     */
    public function disableRenew()
    {
        try {
            DB::beginTransaction();
            // Obtiene la suscripción más reciente del usuario autenticado
            $subscription = Auth::user()->subscriptions()->first();
            // Actualiza la suscripción para desactivar la renovación automática
            Subscription::where('user_id', Auth::id())
                ->where('end_date', '=', $subscription->end_date)
                ->where('start_date', '=', $subscription->start_date)->update(['renew' => 0]);
            DB::commit();

            return redirect()->back()->with('success', 'Renovación automática dada de baja con éxito.');
        } catch (Exception $e) {
            // Si algo sale mal, revierte la transacción
            DB::rollBack();

            // Redirige con un mensaje de error
            return redirect()->back()->with('error', 'Hubo un problema al cancelar la renovación automática de la suscripción.');
        } 
    }
}
