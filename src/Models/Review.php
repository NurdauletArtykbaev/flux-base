<?php

namespace Nurdaulet\FluxBase\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Review extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = ['id'];

    public function reviewable() {
        return $this->morphTo();
    }

    public function messages() {
        return $this->belongsToMany(RatingMessage::class, 'review_rating_message');
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function rating() {
        return $this->belongsTo(Rating::class);
    }

    public function getRatingMessagesAllAttribute()
    {
        $names = $this->loadMissing('ratingMessages')->ratingMessages->pluck('message')->toArray();
        return implode(', ', $names);
    }

    protected $casts = [
        'created_at'   => 'datetime:F',
        'is_processed' => 'boolean',
        'is_skipped' => 'boolean',
    ];
}
