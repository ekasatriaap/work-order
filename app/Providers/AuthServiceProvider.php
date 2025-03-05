<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // Tambahan: Jika ingin spesifik untuk dashboard
        Gate::define('dashboard', function ($user) {
            return true; // Izinkan semua user
        });

        // berikan akses penuh kepada super user
        Gate::before(function ($user, $ablity) {
            return $user->is_root == 1 ? true : null;
        });
    }
}
