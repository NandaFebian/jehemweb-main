<?php

namespace App\Models;

use App\Enums\AttachmentType;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'important_information',
        'visitor_count',
        'contacts',
        'user_id',
        'is_active',
        'is_approved',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'contacts' => 'array',
        'is_active' => 'boolean',
        'is_approved' => 'boolean',
        'visitor_count' => 'integer',
    ];

    public function attachments(): MorphMany
    {
        return $this->morphMany(Attachment::class, 'attachmentable');
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'product_category');
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Products that are visible on the public site (approved by an admin and activated by the owner).
     */
    public function scopePublished(Builder $query): Builder
    {
        return $query->where('is_approved', true)->where('is_active', true);
    }

    /**
     * Average rating, using the `withAvg('comments', 'rating')` aggregate when it was eager loaded.
     */
    public function getAvgRatingAttribute(): float
    {
        $average = array_key_exists('comments_avg_rating', $this->attributes)
            ? $this->attributes['comments_avg_rating']
            : $this->comments()->avg('rating');

        return round((float) $average, 1);
    }

    /**
     * URL of the first image attachment, or a placeholder.
     */
    public function getCoverUrlAttribute(): string
    {
        $image = $this->attachments->firstWhere('type', AttachmentType::IMAGE->value)
            ?? $this->attachments->first();

        return $image?->url ?? asset('images/unknown-product.webp');
    }
}
