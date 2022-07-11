<?php

namespace App\Policies;

use App\Models\CRM\CustomerEnquiry;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CustomerEnquiryPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('backend');
    }

    public function view(User $user, CustomerEnquiry $customerEnquiry)
    {
        return $user->hasPermissionTo('backend');
    }

    public function create(User $user)
    {
        return $user->hasPermissionTo('backend');
    }

    public function update(User $user, CustomerEnquiry $customerEnquiry)
    {
        return $user->hasPermissionTo('backend');
    }

    public function delete(User $user, CustomerEnquiry $customerEnquiry)
    {
        return $user->isFilamentAdmin();
    }

    public function restore(User $user, CustomerEnquiry $customerEnquiry)
    {
        return $user->isFilamentAdmin();
    }

    public function forceDelete(User $user, CustomerEnquiry $customerEnquiry)
    {
        return $user->isFilamentAdmin();
    }
}
