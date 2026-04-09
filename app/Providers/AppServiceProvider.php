<?php

namespace App\Providers;

use App\Models\Setting;
use Carbon\Carbon;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

use function Symfony\Component\Clock\now;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void {}

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // dd(config('auth.guards'));

        // $settings = $settings = Setting::allCached();
        // View::share('settings', $settings);
        \Illuminate\Pagination\Paginator::useBootstrapFive();
    }
}
