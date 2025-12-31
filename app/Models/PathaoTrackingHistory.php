<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * PathaoTrackingHistory Model
 *
 * This model stores the tracking history for Pathao orders
 * to maintain a complete log of order status changes.
 */
class PathaoTrackingHistory extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pathao_tracking_history';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'pathao_order_id',
        'status',
        'status_slug',
        'latitude',
        'longitude',
        'location_name',
        'remarks',
        'timestamp',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'latitude' => 'decimal:10',
        'longitude' => 'decimal:10',
        'timestamp' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the Pathao order that owns this tracking history.
     */
    public function pathaoOrder(): BelongsTo
    {
        return $this->belongsTo(PathaoOrder::class, 'pathao_order_id');
    }

    /**
     * Get location as array.
     *
     * @return array|null
     */
    public function getLocation(): ?array
    {
        if ($this->latitude && $this->longitude) {
            return [
                'latitude' => (float) $this->latitude,
                'longitude' => (float) $this->longitude,
                'location_name' => $this->location_name,
            ];
        }

        return null;
    }

    /**
     * Scope a query to order by timestamp descending.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeLatest($query)
    {
        return $query->orderBy('timestamp', 'desc');
    }
}
