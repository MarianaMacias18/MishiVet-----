<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

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
        // Permitir espacios en nombre <-
        Validator::extend('alpha_spaces', function ($attribute, $value) {
            return preg_match('/^[\p{L} \-]+$/u', $value);
        });
        Validator::extend('phone', function ($attribute, $value) {
            return preg_match('/^[0-9 \-]+$/u', $value);
        });
    }
}
