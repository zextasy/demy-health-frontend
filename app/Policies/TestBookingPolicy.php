<?php

namespace App\Policies;

use App\Models\TestBooking;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TestBookingPolicy
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
        return $user->hasPermissionTo('frontend');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\TestBooking  $testBooking
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, TestBooking $testBooking)
    {
        return $user->hasPermissionTo('backend') || $testBooking->customer_email == $user->email;
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
     * @param  \App\Models\TestBooking  $testBooking
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, TestBooking $testBooking)
    {
        return $user->hasPermissionTo('backend');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\TestBooking  $testBooking
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, TestBooking $testBooking)
    {
        return $user->hasPermissionTo('backend');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\TestBooking  $testBooking
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, TestBooking $testBooking)
    {
        return $user->hasPermissionTo('backend');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\TestBooking  $testBooking
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, TestBooking $testBooking)
    {
        return $user->hasPermissionTo('backend');
    }
}
