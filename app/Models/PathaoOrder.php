<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * PathaoOrder Model
 *
 * This model represents Pathao courier integration for live order tracking
 * with geo-location capabilities.
 */
class PathaoOrder extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pathao_orders';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'order_id',
        'consignment_id',
        'merchant_order_id',
        'store_id',
        'order_status',
        'order_status_slug',
        'delivery_fee',
        'recipient_name',
        'recipient_phone',
        'recipient_address',
        'latitude',
        'longitude',
        'tracking_data',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'delivery_fee' => 'decimal:2',
        'latitude' => 'decimal:10',
        'longitude' => 'decimal:10',
        'tracking_data' => 'array',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Pathao Order Status Constants
     */
    public const STATUS_PENDING = 'Pending';
    public const STATUS_IN_TRANSIT = 'In Transit';
    public const STATUS_DELIVERED = 'Delivered';
    public const STATUS_CANCELLED = 'Cancelled';
    public const STATUS_RETURNED = 'Returned';
    public const STATUS_PICKUP_PENDING = 'Pickup Pending';
    public const STATUS_PICKED_UP = 'Picked Up';
    public const STATUS_AT_HUB = 'At Hub';
    public const STATUS_OUT_FOR_DELIVERY = 'Out for Delivery';

    /**
     * Status labels mapping
     *
     * @var array
     */
    protected $statusLabels = [
        self::STATUS_PENDING => 'Pending',
        self::STATUS_IN_TRANSIT => 'In Transit',
        self::STATUS_DELIVERED => 'Delivered',
        self::STATUS_CANCELLED => 'Cancelled',
        self::STATUS_RETURNED => 'Returned',
        self::STATUS_PICKUP_PENDING => 'Pickup Pending',
        self::STATUS_PICKED_UP => 'Picked Up',
        self::STATUS_AT_HUB => 'At Hub',
        self::STATUS_OUT_FOR_DELIVERY => 'Out for Delivery',
    ];

    /**
     * Get the order that owns this Pathao order.
     */
    public function order(): BelongsTo
    {
        return $this->belongsTo(\Webkul\Sales\Models\Order::class, 'order_id');
    }

    /**
     * Get the tracking history for this Pathao order.
     */
    public function trackingHistory(): HasMany
    {
        return $this->hasMany(PathaoTrackingHistory::class, 'pathao_order_id');
    }

    /**
     * Get the status label from status code.
     *
     * @return string
     */
    public function getStatusLabelAttribute(): string
    {
        return $this->statusLabels[$this->order_status] ?? $this->order_status;
    }

    /**
     * Update tracking information from Pathao API.
     *
     * @param array $trackingData
     * @return bool
     */
    public function updateTracking(array $trackingData): bool
    {
        $this->order_status = $trackingData['status'] ?? $this->order_status;
        $this->order_status_slug = $trackingData['status_slug'] ?? $this->order_status_slug;

        if (isset($trackingData['latitude'])) {
            $this->latitude = $trackingData['latitude'];
        }

        if (isset($trackingData['longitude'])) {
            $this->longitude = $trackingData['longitude'];
        }

        // Merge tracking data
        $existingTracking = $this->tracking_data ?? [];
        $newTracking = $trackingData['tracking_history'] ?? [];

        if (!empty($newTracking)) {
            $this->tracking_data = array_merge($existingTracking, $newTracking);
        }

        return $this->save();
    }

    /**
     * Get current location as array.
     *
     * @return array|null
     */
    public function getLocation(): ?array
    {
        if ($this->latitude && $this->longitude) {
            return [
                'latitude' => (float) $this->latitude,
                'longitude' => (float) $this->longitude,
            ];
        }

        return null;
    }

    /**
     * Get complete tracking history.
     *
     * @return array
     */
    public function getTrackingHistory(): array
    {
        return $this->tracking_data ?? [];
    }

    /**
     * Check if order is delivered.
     *
     * @return bool
     */
    public function isDelivered(): bool
    {
        return $this->order_status === self::STATUS_DELIVERED;
    }

    /**
     * Check if order is in transit.
     *
     * @return bool
     */
    public function isInTransit(): bool
    {
        return in_array($this->order_status, [
            self::STATUS_IN_TRANSIT,
            self::STATUS_PICKED_UP,
            self::STATUS_AT_HUB,
            self::STATUS_OUT_FOR_DELIVERY,
        ]);
    }

    /**
     * Check if order is pending.
     *
     * @return bool
     */
    public function isPending(): bool
    {
        return $this->order_status === self::STATUS_PENDING;
    }

    /**
     * Check if order is cancelled.
     *
     * @return bool
     */
    public function isCancelled(): bool
    {
        return $this->order_status === self::STATUS_CANCELLED;
    }

    /**
     * Check if order is returned.
     *
     * @return bool
     */
    public function isReturned(): bool
    {
        return $this->order_status === self::STATUS_RETURNED;
    }

    /**
     * Check if order is out for delivery.
     *
     * @return bool
     */
    public function isOutForDelivery(): bool
    {
        return $this->order_status === self::STATUS_OUT_FOR_DELIVERY;
    }

    /**
     * Get delivery fee formatted.
     *
     * @return string
     */
    public function getFormattedDeliveryFee(): string
    {
        return number_format($this->delivery_fee, 2);
    }

    /**
     * Scope a query to only include pending orders.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePending($query)
    {
        return $query->where('order_status', self::STATUS_PENDING);
    }

    /**
     * Scope a query to only include in-transit orders.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeInTransit($query)
    {
        return $query->whereIn('order_status', [
            self::STATUS_IN_TRANSIT,
            self::STATUS_PICKED_UP,
            self::STATUS_AT_HUB,
            self::STATUS_OUT_FOR_DELIVERY,
        ]);
    }

    /**
     * Scope a query to only include delivered orders.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeDelivered($query)
    {
        return $query->where('order_status', self::STATUS_DELIVERED);
    }

    /**
     * Scope a query to only include cancelled orders.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeCancelled($query)
    {
        return $query->where('order_status', self::STATUS_CANCELLED);
    }

    /**
     * Scope a query to only include returned orders.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeReturned($query)
    {
        return $query->where('order_status', self::STATUS_RETURNED);
    }

    /**
     * Find Pathao order by consignment ID.
     *
     * @param string $consignmentId
     * @return static|null
     */
    public static function findByConsignmentId(string $consignmentId): ?self
    {
        return static::where('consignment_id', $consignmentId)->first();
    }

    /**
     * Find Pathao order by merchant order ID.
     *
     * @param string $merchantOrderId
     * @return static|null
     */
    public static function findByMerchantOrderId(string $merchantOrderId): ?self
    {
        return static::where('merchant_order_id', $merchantOrderId)->first();
    }
}
