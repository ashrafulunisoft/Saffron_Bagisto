<?php

namespace Webkul\Product\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Webkul\Product\Contracts\ProductImage as ProductImageContract;

class ProductImage extends Model implements ProductImageContract
{
    /**
     * Timestamp.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Fillable.
     *
     * @var array
     */
    protected $fillable = [
        'type',
        'path',
        'product_id',
        'position',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['url'];

    /**
     * Get the product that owns the image.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo(ProductProxy::modelClass());
    }

    /**
     * Get image url for the product image.
     *
     * @return string
     */
    public function url()
    {
        $storageUrl = Storage::url($this->path);

        // If the storage URL contains localhost, replace with current request host and port
        if (str_contains($storageUrl, 'localhost')) {
            $request = request();
            $currentHost = $request->getHost();
            $currentPort = $request->getPort();

            $scheme = $request->getScheme();
            $baseUrl = $scheme . '://' . $currentHost;

            if ($currentPort && $currentPort != 80 && $currentPort != 443) {
                $baseUrl .= ':' . $currentPort;
            }

            // Replace localhost URL parts with current request URL
            $storageUrl = preg_replace(
                '/https?:\/\/localhost(:\d+)?\/public\/storage\//',
                $baseUrl . '/storage/',
                $storageUrl
            );

            $storageUrl = preg_replace(
                '/https?:\/\/localhost(:\d+)?\/storage\//',
                $baseUrl . '/storage/',
                $storageUrl
            );
        }

        return $storageUrl;
    }

    /**
     * Get image url for the product image.
     *
     * @return string
     */
    public function getUrlAttribute()
    {
        return $this->url();
    }

    /**
     * Is custom attribute.
     *
     * @param  string  $key
     * @return bool
     */
    public function isCustomAttribute($attribute)
    {
        return $this->attribute_family->custom_attributes->pluck('code')->contains($attribute);
    }
}
