<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;

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
        // Paginator::defaultView('vendor.pagination.custom');
        Blade::directive('rupiah', function ($expression) {
            return "Rp. <?php echo number_format($expression,0,',','.'); ?>";
        });
        Paginator::useBootstrapFive();
    }
}
