<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Auth;
use App\Extensions\Auth\EloquentUserProvider;
use App\Extensions\Auth\MD5Hasher as MD5Hasher;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('Admin', function ($user) {
            return $user->isAdmin() ? Response::allow()
            : Response::deny('You must be an administrator');
        });

        Auth::provider('eloquent_md5', function ($app, array $config) {
            return new EloquentUserProvider(new MD5Hasher(), $config['model']);
        });
    }
}
