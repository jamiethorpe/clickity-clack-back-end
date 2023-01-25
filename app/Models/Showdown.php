<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Showdown extends Model
{
    use HasFactory, HasUuids;

    public $incrementing = false;

    protected $fillable = [
        'user_id',
        'completed_at',
    ];

    // Relationships

    public function winner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function combatants()
    {
        return $this->belongsToMany(User::class, 'showdowns_users')->withTimestamps();
    }

    public function rounds()
    {
        return $this->hasMany(Round::class);
    }

    public function scopeCompleted(Builder $query)
    {
        return $query->whereNotNull('showdowns.user_id');
    }
}
