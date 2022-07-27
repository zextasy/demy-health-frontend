<?php

namespace App\Policies;

use App\Models\User;
use App\Settings\GeneralSettings;
use Illuminate\Auth\Access\HandlesAuthorization;

class GeneralSettingsPolicy
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
        return $user->hasPermissionTo('admin');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Settings\GeneralSettings  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, GeneralSettings $model)
    {
        return $user->hasPermissionTo('admin');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('admin');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Settings\GeneralSettings  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, GeneralSettings $model)
    {
        return $user->hasPermissionTo('admin');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Settings\GeneralSettings  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, GeneralSettings $model)
    {
        return $user->hasPermissionTo('admin');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Settings\GeneralSettings  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, GeneralSettings $model)
    {
        return $user->hasPermissionTo('admin');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Settings\GeneralSettings  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, GeneralSettings $model)
    {
        return $user->hasPermissionTo('admin');
    }
}
