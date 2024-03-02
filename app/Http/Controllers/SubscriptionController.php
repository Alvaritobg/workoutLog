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
     * Crea una nueva suscripción en la base de datos.
     * 
     * Este método valida la entrada del usuario para asegurar que el 'user_id' proporcionado
     * existe en la base de datos y que el campo 'auto_renew' si se proporciona, sea un valor booleano.
     * Realiza una verificación de seguridad para asegurar que el usuario autenticado solo pueda crear
     * una suscripción para sí mismo. Utiliza transacciones de la base de datos para asegurar que todos
     * los cambios se realicen correctamente antes de ser confirmados. Si ocurre un error durante el proceso,
     * la transacción se revierte para mantener la consistencia de los datos.
     *
     * @param  \Illuminate\Http\Request  $request  La solicitud HTTP, que incluye el 'user_id' del usuario
     *                                             a suscribir y un campo opcional 'auto_renew' para la renovación automática.
     * @return \Illuminate\Http\Response           Redirige al usuario a la página anterior con un mensaje de éxito
     *                                             o error, dependiendo del resultado de la operación.
     */
    public function store(Request $request)
    {
        // Validación de la solicitud
        $request->validate([
            'user_id' => 'required|exists:users,id', // Asegura que el 'user_id' proporcionado exista en la tabla de usuarios.
            'auto_renew' => 'sometimes|boolean', // Valida que 'auto_renew', si se proporciona, sea un valor booleano.
        ]);

        try {
            // Verifica que el usuario autenticado esté intentando suscribirse a sí mismo
            if (Auth::id() != $request['user_id']) {
                // Si el 'user_id' no coincide con el usuario autenticado, impide la acción y redirige con un mensaje de error.
                return redirect()->back()->with('error', 'No tiene permisos para realizar la suscripción a otro usuario.');
            }

            // Inicia una transacción de base de datos para garantizar la integridad de los datos.
            DB::beginTransaction();

            // Crea y configura la nueva suscripción
            $subscription = new Subscription();
            $subscription->user_id = $request->user_id; // Asigna el 'user_id' de la solicitud
            $subscription->renew = $request->has('auto_renew'); // Configura la renovación automática basada en la presencia del campo 'auto_renew'
            $subscription->paid = true; // Marca la suscripción como pagada
            $subscription->start_date = now(); // Establece la fecha de inicio de la suscripción como la fecha actual
            $subscription->end_date = now()->addMonth(); // Establece la fecha de fin de la suscripción para un mes después de la fecha actual
            $subscription->save(); // Guarda la suscripción en la base de datos

            // Confirma la transacción si todo sale bien
            DB::commit();

            // Redirige al usuario a la página anterior con un mensaje de éxito.
            return redirect()->back()->with('success', 'Suscripción realizada con éxito.');
        } catch (Exception $e) {
            // Revierte la transacción si algo sale mal durante el proceso
            DB::rollBack();

            // Redirige al usuario a la página anterior con un mensaje de error.
            return redirect()->back()->with('error', 'Hubo un problema al realizar la suscripción.');
        }
    }

    /**
     * Desactiva la renovación automática de la suscripción más reciente del usuario autenticado.
     *
     * Este método busca la suscripción más reciente del usuario autenticado y actualiza su estado para desactivar
     * la renovación automática. Utiliza transacciones de base de datos para asegurar que los cambios se realicen
     * de manera atómica, lo que significa que si ocurre un error durante el proceso, todos los cambios se revertirán
     * para mantener la consistencia de los datos.
     *
     * @return \Illuminate\Http\Response Redirige al usuario a la página anterior con un mensaje de éxito o error.
     */
    public function disableRenew()
    {
        try {
            // Inicia una transacción de base de datos para asegurar la atomicidad de la operación.
            DB::beginTransaction();

            // Obtiene la suscripción más reciente del usuario autenticado.
            $subscription = Auth::user()->subscriptions()->first();

            // Actualiza la suscripción para desactivar la renovación automática.
            // Se busca la suscripción específica del usuario basándose en las fechas de inicio y fin.
            Subscription::where('user_id', Auth::id())
                ->where('end_date', '=', $subscription->end_date)
                ->where('start_date', '=', $subscription->start_date)
                ->update(['renew' => 0]);

            // Si todo sale bien, confirma la transacción para hacer permanentes los cambios.
            DB::commit();

            // Redirige al usuario a la página anterior con un mensaje de éxito.
            return redirect()->back()->with('success', 'Renovación automática dada de baja con éxito.');
        } catch (Exception $e) {
            // Si algo sale mal durante el proceso, revierte todos los cambios realizados durante la transacción.
            DB::rollBack();

            // Redirige al usuario a la página anterior con un mensaje de error.
            return redirect()->back()->with('error', 'Hubo un problema al cancelar la renovación automática de la suscripción.');
        }
    }
}
