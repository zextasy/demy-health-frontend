<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsMigrate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        foreach ($this->permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        foreach ($this->roles as $role_up) {
            $role = Role::create(['name' => $role_up]);

            foreach ($this->rolePermissions($role_up) as $role_permissions) {
                $role->givePermissionTo($role_permissions);
            }
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
    }

    private $permissions = [
        'admin',
         'backend',
        'frontend',
        'process test booking',
    ];

    private $roles       = [
        'admin',
        'manager',
        'editor',
        'customer',
    ];

    private function rolePermissions($role){

        $role_permissions = [
            'admin' => ['admin', 'backend', 'frontend','process test booking',],
             'manager' => ['backend','process test booking',],
            'editor' => ['backend'],
             'customer' => ['frontend'],
        ];

        return (isset($role_permissions[$role]))? $role_permissions[$role] : [];
    }

}
?>
