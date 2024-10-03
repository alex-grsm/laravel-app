<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Listing extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['beds', 'baths', 'area', 'city', 'code', 'street', 'street_nr', 'price'];

    protected $sortable = [
        'price',
        'created_at'
    ];

    /**
     * The user that created the listing
     *
     * @return BelongsTo
     */
    public function owner(): BelongsTo
    {
        return $this->belongsTo(
            \App\Models\User::class,
            'by_user_id'
        );
    }

    /**
     * All images associated with this listing
     *
     * @return HasMany<\App\Models\ListingImage>
     */
    public function images(): HasMany
    {
        return $this->hasMany(ListingImage::class);
    }
    public function offers(): HasMany
    {
        return $this->hasMany(Offer::class, 'listing_id');
    }


    // public function scopeMostRecent($query): Builder {
    //     return $query->orderByDesc('created_at');
    // }

    public function scopeWithoutSold(Builder $query): Builder
    {
        return $query->doesntHave('offers')
            ->orWhereHas(
                'offers',
                fn(Builder $query) => $query->whereNull('accepted_at')
                    ->whereNull('rejected_at')
            );

        // return $query->whereNull('sold_at');
    }

    /**
     * Scope a query to only include listings matching the given filters.
     *
     * Available filters are:
     * - priceFrom: The minimum price of the listing
     * - priceTo: The maximum price of the listing
     * - beds: The amount of beds in the listing (integer, or "6+" for 6 or more)
     * - baths: The amount of baths in the listing (integer, or "6+" for 6 or more)
     * - areaFrom: The minimum area of the listing
     * - areaTo: The maximum area of the listing
     * - deleted: Whether to include deleted listings
     * - by: The field to order the listings by (one of 'price', 'created_at')
     * - order: The order to use for the given field (one of 'asc', 'desc')
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  array  $filters
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFilter(Builder $query, array $filters): Builder
    {
        return $query->when(
            $filters['priceFrom'] ?? false,
            fn($query, $value) => $query->where('price', '>=', $value)
        )->when(
            $filters['priceTo'] ?? false,
            fn($query, $value) => $query->where('price', '<=', $value)
        )->when(
            $filters['beds'] ?? false,
            fn($query, $value) => $query->where('beds', (int)$value < 6 ? '=' : '>=', $value)
        )->when(
            $filters['baths'] ?? false,
            fn($query, $value) => $query->where('baths', (int)$value < 6 ? '=' : '>=', $value)
        )->when(
            $filters['areaFrom'] ?? false,
            fn($query, $value) => $query->where('area', '>=', $value)
        )->when(
            $filters['areaTo'] ?? false,
            fn($query, $value) => $query->where('area', '<=', $value)
        )->when(
            $filters['deleted'] ?? false,
            fn($query, $value) => $query->withTrashed()
        )->when(
            $filters['by'] ?? false,
            fn($query, $value) =>
            !in_array($value, $this->sortable)
                ? $query :
                $query->orderBy($value, $filters['order'] ?? 'desc')
        );
    }
}
