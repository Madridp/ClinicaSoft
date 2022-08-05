<?php

namespace App\Providers;


use Illuminate\Contracts\Auth\Access\Gate as AccessGate;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Gate::define('usuario-create', function ($user) {
            if ($user->id_rol == '1') {
                return true;
            }
            return false;
        });

        Gate::define('paciente', function ($user) {
            if ($user->id_rol != '3') {
                return true;
            }
            return false;
        });
        Gate::define('tecnico', function ($user) {
            if ($user->id_rol != '3') {
                return true;
            }
            return false;
        });
        Gate::define('medicoReferente', function ($user) {
            if ($user->id_rol != '3') {
                return true;
            }
            return false;
        });

        Gate::define('insumo', function ($user) {
            if ($user->id_rol != '3') {
                return true;
            }
            return false;
        });
        Gate::define('compra', function ($user) {
            if ($user->id_rol != '3') {
                return true;
            }
            return false;
        });
        
    }
}
