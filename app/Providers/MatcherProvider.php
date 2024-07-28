<?php

namespace App\Providers;

use App\Http\RealStats\Services\MatcherService;
use Illuminate\Support\ServiceProvider;

class MatcherProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind('MatcherService',function(){

            return new MatcherService();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
