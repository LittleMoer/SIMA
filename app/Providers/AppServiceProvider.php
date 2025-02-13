<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Routing\UrlGenerator;

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
    public function boot(UrlGenerator $url): void
    {
        Blade::directive('currency', function ( $expression ) 
    {  return "Rp. <?php echo number_format($expression,0,',','.'); ?>"; });
    // $url ->forceScheme('https');
    }
    
}