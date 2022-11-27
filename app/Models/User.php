<?php

namespace App\Models;

use App\Contracts\AddressableContract;
use App\Contracts\OrderableContract;
use App\Traits\Relationships\HasTasks;
use App\Contracts\InvoiceableContract;
use App\Traits\Models\LaravelMorphable;
use App\Traits\Relationships\MorphsInvoices;
use App\Traits\Relationships\BelongsToBusinessGroup;
use App\Traits\Relationships\HasTestBookings;
use App\Traits\Relationships\MorphsAddresses;
use App\Traits\Relationships\MorphsOrders;
use Filament\Models\Contracts\FilamentUser;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasPermissions;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements
    FilamentUser,
    MustVerifyEmail,
    AddressableContract,
    OrderableContract,
    InvoiceableContract
{
    use SoftDeletes;
    use HasApiTokens;
    use HasFactory;
    use Notifiable;
    use HasRoles;
    use HasPermissions;
    use HasTestBookings;
    use MorphsAddresses;
    use MorphsOrders;
    use MorphsInvoices;
    use BelongsToBusinessGroup;
    use HasTasks;
    use LaravelMorphable;

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
        return $this->hasAnyPermission(['frontend', 'backend']);
    }

    public function isFilamentAdmin()
    {
        return $this->hasPermissionTo('admin');
    }
    //endregion

    //region SCOPES

    //endregion

    //region RELATIONSHIPS
    public function testBookings(): HasMany
    {
        return $this->hasMany(TestBooking::class, 'customer_email', 'email');
    }

    public function testResults(): HasMany
    {
        return $this->hasMany(TestResult::class, 'customer_email', 'email');
    }

    //endregion
}
