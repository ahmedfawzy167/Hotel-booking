<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        Schema::defaultStringLength(200);

        Password::defaults(function () {
            $rule = Password::min(10)->numbers()->symbols()->mixedCase();
            return $this->app->isProduction()
                ? $rule->uncompromised(3)
                : $rule;
        });
    }
}
