<?php

namespace App\Providers;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        /*
        View::composer(
            'history.history', 'App\Http\ViewComposers\DateTimeComposer'
        );
        */
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
