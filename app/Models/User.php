<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use App\Contracts\OrderableContract;
use Spatie\Permission\Traits\HasRoles;
use App\Contracts\AddressableContract;
use Illuminate\Notifications\Notifiable;
use App\Traits\Relationships\MorphsOrders;
use Filament\Models\Contracts\FilamentUser;
use Spatie\Permission\Traits\HasPermissions;
use App\Traits\Relationships\MorphsAddresses;
use App\Traits\Relationships\HasTestBookings;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements FilamentUser, MustVerifyEmail, AddressableContract, OrderableContract
{
    use  SoftDeletes, HasApiTokens, HasFactory, Notifiable, HasRoles, HasPermissions, HasTestBookings, MorphsAddresses, MorphsOrders;

    //region CONFIG
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $dates = ['created_at', 'updated_at'];

    //endregion

    //region ATTRIBUTES

    //endregion

    //region HELPERS
    public function canAccessFilament(): bool
    {
        return $this->hasAnyPermission(['frontend','backend']);
    }

    public function isFilamentAdmin()
    {
        return $this->hasPermissionTo('admin');
    }
    //endregion

    //region SCOPES

    //endregion

    //region RELATIONSHIPS
    public function TestBookings(): HasMany
    {
        return $this->hasMany(TestBooking::class, 'customer_email', 'email');
    }
    //endregion


}
