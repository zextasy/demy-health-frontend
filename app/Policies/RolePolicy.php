<?php

namespace App\Policies;

use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('backend');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Spatie\Permission\Models\Role  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Role $model)
    {
        return $user->hasPermissionTo('backend');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('backend');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Spatie\Permission\Models\Role  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Role $model)
    {
        return $user->hasPermissionTo('backend');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Spatie\Permission\Models\Role  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Role $model)
    {
        return $user->hasPermissionTo('backend');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Spatie\Permission\Models\Role  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Role $model)
    {
        return $user->hasPermissionTo('backend');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Spatie\Permission\Models\Role  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Role $model)
    {
        return $user->hasPermissionTo('backend');
    }
}
