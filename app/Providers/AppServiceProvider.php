<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        Blade::component('componentes._home','home');
        Blade::component('componentes._card','card');
        Blade::component('componentes._catalogo','catalogo');
        Blade::component('componentes._form_full_modal','formFullModal');
        Blade::component('componentes.tools._form_full_modal_search','formFullModalSearch');
        Blade::component('componentes._asignaciones','asignaciones');
        Blade::component('componentes._details','details');

        Blade::component('componentes._denuncia','denunciaContainer');
        Blade::component('componentes.tools._buttonsFormDenuncia','buttonsFormDenuncia');


    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
