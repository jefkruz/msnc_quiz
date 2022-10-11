<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
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
        /* define a  awardee user role */
        Gate::define('isApplicant', function($user) {
            //  dd($user->role->name);
            return $user->roles->name == 'user';
        });

        /* define a admin user role */
        Gate::define('isAdmin', function($user) {
            return $user->roles->name == 'admin';
        });

        //
    }
}
