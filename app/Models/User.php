<?php

namespace App\Models;

use Filament\Panel;
use App\Contracts\PayerContract;
use Laravel\Sanctum\HasApiTokens;
use App\Contracts\AddressableContract;
use App\Traits\Relationships\HasTasks;
use Spatie\Permission\Traits\HasRoles;
use App\Traits\Models\LaravelMorphable;
use App\Contracts\CommunicableContract;
use Illuminate\Notifications\Notifiable;
use Filament\Models\Contracts\FilamentUser;
use App\Traits\Models\RoutesCommunications;
use App\Contracts\OrderableCustomerContract;
use Spatie\Permission\Traits\HasPermissions;
use App\Traits\Relationships\HasTestBookings;
use App\Traits\Relationships\MorphsAddresses;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Contracts\InvoiceableCustomerContract;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Traits\Relationships\HasPaymentsViaEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Traits\Relationships\BelongsToBusinessGroup;
use App\Traits\Relationships\MorphsOrdersAsCustomer;
use App\Traits\Relationships\MorphsInvoicesAsCustomer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements
    FilamentUser,
    MustVerifyEmail,
    AddressableContract,
    OrderableCustomerContract,
    InvoiceableCustomerContract,
    PayerContract,
    CommunicableContract
{
    use SoftDeletes;
    use HasApiTokens;
    use HasFactory;
    use Notifiable;
    use HasRoles;
    use HasPermissions;
    use HasTestBookings;
    use MorphsAddresses;
    use MorphsOrdersAsCustomer;
    use MorphsInvoicesAsCustomer;
    use HasPaymentsViaEmail;
    use BelongsToBusinessGroup;
    use HasTasks;
    use LaravelMorphable;
    use RoutesCommunications;

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
    protected function fullName(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->getFullName(),
        );
    }
    //endregion

    //region HELPERS
    public function canAccessFilament(): bool
    {
        return $this->hasAnyPermission(['frontend', 'backend','admin']);
    }

    public function isFilamentFrontendUser(): bool
    {
        return $this->hasPermissionTo('frontend');
    }

    public function isFilamentBackendUser(): bool
    {
        return $this->hasPermissionTo('backend');
    }

    public function isFilamentAdmin(): bool
    {
        return $this->hasPermissionTo('admin');
    }
    public function canAccessPanel(Panel $panel): bool
    {
        return $this->canAccessFilament();
    }
    public function getFullName():string
    {
        $name = $this->name;

        if ($this->patient()->exists()) {
            $name = $this->patient->full_name;
        }

        return $name;
    }

    public function getEmailForPayment(): ?string
    {
        return $this->email;
    }

    public function routeNotificationForSMS()
    {
        return $this->patient->phone_number;
    }
    //endregion

    //region SCOPES

    //endregion

    //region RELATIONSHIPS
    public function patient(): HasOne
    {
        return $this->hasOne(Patient::class, 'email', 'email');
    }
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
