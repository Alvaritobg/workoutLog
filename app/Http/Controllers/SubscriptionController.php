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




class SubscriptionController extends Controller
{
    public function store(Request $request)
    {
        // Validación de la solicitud
    $request->validate([
        'user_id' => 'required|exists:users,id', // Asegúrate de que la tabla se llama 'users', no 'user'
        'auto_renew' => 'sometimes|boolean',
    ]);

            try {
                // Inicia una transacción de base de datos
                DB::beginTransaction();

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

    
    public function disableRenew()
    {
        try {
            DB::beginTransaction();
            $subscription = Auth::user()->subscriptions()->first();
            Subscription::where('user_id', Auth::id())
            ->where('end_date', '=', $subscription->end_date)
            ->where('start_date', '=', $subscription->start_date)->update(['renew' => 0]);
            DB::commit();

            return redirect()->back()->with('success', 'Renovación auntomática dada de baja con éxito.');
        } catch(e) {
            // Si algo sale mal, revierte la transacción
            DB::rollBack();

            // Redirige con un mensaje de error
            return redirect()->back()->with('error', 'Hubo un problema al cancelar la renovación automatica de la subscripción.');
        } 
      /*   try {
            // Inicia una transacción de base de datos
            DB::beginTransaction();
            $subscription = Auth::user()->subscriptions()->first();

            DB::table('subscriptions')
                ->where('user_id', Auth::id())
                ->where('end_date', '=', $subscription->end_date)
                ->where('start_date', '=', $subscription->start_date)
            ->update(['renew' => 0]);
            DB::commit();

                return redirect()->back()->with('success', 'Renovación auntomática dada de baja con éxito.');
    
        } catch(e) {
            // Si algo sale mal, revierte la transacción
            DB::rollBack();

            // Redirige con un mensaje de error
            return redirect()->back()->with('error', 'Hubo un problema al cancelar la renovación automatica de la subscripción.');
        } */
    }

}