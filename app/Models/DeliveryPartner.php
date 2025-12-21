<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DeliveryPartner extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'contact_number',
        'email',
        'status',
    ];

    /**
     * Get delivery bookings for delivery partner.
     */
    public function deliveryBookings(): HasMany
    {
        return $this->hasMany(DeliveryBooking::class);
    }
}
