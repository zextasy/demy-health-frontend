<?php

namespace App\Providers;

use App\Policies\GeneralSettingsPolicy;
use App\Policies\PermissionPolicy;
use App\Policies\RolePolicy;
use App\Settings\GeneralSettings;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        Role::class => RolePolicy::class,
        Permission::class => PermissionPolicy::class,
        GeneralSettings::class => GeneralSettingsPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
