<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Section;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Gate;
class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $minutes = 0; // 1 hour
        $sections = Cache::remember('sections', $minutes, function () {
            return Section::all();
        });

        $scopes = [];
        foreach ($sections as $section) {
            $scopes[$section->name] = $section->caption;
            Gate::define($section->name, function ($user) use ($section) {
                return $user->hasPermission($section->name);
            });
        }
    }
}
