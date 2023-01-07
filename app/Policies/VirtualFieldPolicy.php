<?php

namespace App\Policies;

use App\Models\User;
use App\Models\VirtualField;
use Illuminate\Auth\Access\HandlesAuthorization;

class VirtualFieldPolicy
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
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\VirtualField  $virtualField
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, VirtualField $virtualField)
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\VirtualField  $virtualField
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, VirtualField $virtualField)
    {
        return true;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\VirtualField  $virtualField
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, VirtualField $virtualField)
    {
        return true;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\VirtualField  $virtualField
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, VirtualField $virtualField)
    {
        return true;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\VirtualField  $virtualField
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, VirtualField $virtualField)
    {
        return true;
    }
}
