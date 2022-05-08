<?php

namespace App\Providers;

use App\Policies\RolePolicy;
use App\Settings\GeneralSettings;
use Spatie\Permission\Models\Role;
use App\Policies\PermissionPolicy;
use App\Policies\GeneralSettingsPolicy;
use Spatie\Permission\Models\Permission;
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
