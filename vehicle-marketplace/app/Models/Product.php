<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Product extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = ['name', 'slug', 'description', 'image', 'price', 'quantity', 'view', 'category_id'];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class)->orderBy('sort_order');
    }

    /**
     * Register media collections for product gallery
     */
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('gallery')
            ->useFallbackUrl($this->image ?: 'https://via.placeholder.com/800x600?text=No+Image')
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/webp', 'image/gif']);
    }

    /**
     * Register media conversions for thumbnails
     */
    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(300)
            ->height(200)
            ->sharpen(10)
            ->nonQueued();

        $this->addMediaConversion('medium')
            ->width(800)
            ->height(600)
            ->sharpen(10)
            ->nonQueued();
    }

    /**
     * Get the first gallery image URL or fallback to main image
     */
    public function getFirstGalleryImageAttribute(): string
    {
        $media = $this->getFirstMedia('gallery');
        return $media ? $media->getUrl() : ($this->image ?: 'https://via.placeholder.com/800x600?text=No+Image');
    }

    /**
     * Get all gallery image URLs
     */
    public function getGalleryImagesAttribute()
    {
        return $this->getMedia('gallery');
    }
}
