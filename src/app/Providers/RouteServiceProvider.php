<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/admin/profile';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        $this->configureRateLimiting();

        $this->routes(function (Request $request) {
            // $host = $request->getHost();
            // $host_array = explode(".",$host);
            // dd($host_array);
            // Route::middleware('api')
            //     ->prefix('api')
            //     ->group(base_path('routes/api.php'));

            // Route::middleware('web')
            //     ->prefix('admin')
            //     ->group(base_path('routes/admin_web.php'));

            // if(count($host_array)==2){
                Route::middleware('web')
                    ->group(base_path('routes/web.php'));
                Route::middleware('web')
                    ->group(base_path('routes/common_web.php'));
                Route::middleware('web')->prefix('admin')->group(base_path('routes/admin_web.php'));
            // }

            // if(count($host_array)==3 && $host_array[0]=='api'){
            //     Route::domain($host)->middleware('api')->group(base_path('routes/api.php'));
            // }

            // if(count($host_array)==3 && $host_array[0]=='admin'){
            //     Route::domain($host)->middleware('web')->group(base_path('routes/admin_web.php'));
            // }

            // if(count($host_array)==3){
            //     $url = '{slug?}.'.$host_array[1].'.'.$host_array[2];
            //     Route::domain($url)->middleware('web')->group(base_path('routes/project_web.php'));
            //     Route::domain($host)->middleware('web')
            //         ->group(base_path('routes/common_web.php'));
            // }

        });
    }

    /**
     * Configure the rate limiters for the application.
     */
    protected function configureRateLimiting(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }
}
