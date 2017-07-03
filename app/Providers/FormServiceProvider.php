<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Http\Formbuilders;

class FormServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('wangyongtao.form', function ($app) {
            $formBuilder = new FormBuilders();
            // $formBuilder->setErrorStore($app['adamwathan.form.errorstore']);
            // $formBuilder->setOldInputProvider($app['adamwathan.form.oldinput']);
            // $formBuilder->setToken($app['session.store']->token());
            return $formBuilder;
        });
        // $this->app->singleton(Connection::class, function ($app) {

        //     return new Connection(config('riak'));
        // });
    }
}
