<?php

namespace App\Providers;

use App\Models\Party;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to your application's "home" route.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const ADMIN = '/admin/games';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        parent::boot();

        Route::bind('player_uuid', function ($uuid) {
            return Party::query()->where('player_uuid', '=', $uuid)->firstOrFail();
        });

        Route::bind('moderator_uuid', function ($uuid) {
            return Party::query()->where('moderator_uuid', '=', $uuid)->firstOrFail();
        });

        Route::bind('party_id', function ($party_id) {
            return Party::query()->find($party_id);
        });

        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });
    }
}
