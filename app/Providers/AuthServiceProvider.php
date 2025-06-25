<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        // Define a gate for admin access
        Gate::define('admin-only', function ($user) {
            return $user->isAdmin();
        });

        // Define a gate for edit/delete permissions
        Gate::define('edit-delete-access', function ($user) {
            return $user->isAdmin(); // Only admin can edit/delete
        });
    }
}