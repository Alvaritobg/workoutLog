<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Carbon\Carbon;
use App\Models\Subscription;


class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     * Es necesario añadir al crontab: * * * * * cd /var/www/html/workoutLog  && php artisan schedule:run >> /dev/null 2>&1
     * crontab -e para añadir y crontab -l para comprobar los cambios
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->call(function () {
            // Obtener todas las suscripciones que acaban hoy y tienen el valor 'renew' a 1
            $subscriptions = \App\Models\Subscription::where('end_date', Carbon::today())
                                                     ->where('renew', 1)
                                                     ->get();
    
            foreach ($subscriptions as $subscription) {
                // Crear una nueva suscripción con la misma duración
                $newSubscription = $subscription->replicate(['start_date', 'end_date']);
                $newSubscription->start_date = $subscription->end_date->addDay();
                $newSubscription->end_date = $newSubscription->start_date->addMonth(); // Asumiendo que la duración es de un mes
                $newSubscription->save();
            }
        })->daily();
    }


    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
