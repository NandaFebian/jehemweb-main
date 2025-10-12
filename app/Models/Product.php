<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
        'is_approved' => 'boolean',
    ];

    protected $appends = [
        'avg_rating',
    ];

    public function attachments()
    {
        return $this->morphMany(Attachment::class, 'attachmentable');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'product_category');
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getAvgRatingAttribute(): float
    {
        $count = $this->comments->count();
        if (! $count) {
            return 0;
        }

        $total = 0;
        foreach ($this->comments as $comment) {
            $total += $comment->rating;
        }

        return $total / $count;
    }
}
