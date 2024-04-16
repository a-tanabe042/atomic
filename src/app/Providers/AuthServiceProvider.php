<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [

    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //管理者
        Gate::define('admin', function ($user) {
            return $user->auth_name == 'admin';
        });

        // 営業
        Gate::define('sales', function ($user) {
            return ($user->auth_name == 'sales');
        });

        //採用
        Gate::define('recruitment', function ($user) {
            return $user->auth_name == 'recruitment';
        });

        // メンバー
        Gate::define('member', function ($user) {
            return ($user->auth_name == 'member');
        });
    }
}
