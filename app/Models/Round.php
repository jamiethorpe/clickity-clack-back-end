<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Round extends Model
{
    use HasFactory;

    protected $fillable = [
        'showdown_id',
        'user_id',
        'technique',
    ];

    // 984e2106-5f8b-440b-b1d6-e54b6cbc1791

    public function showdown()
    {
        return $this->belongsTo(Showdown::class);
    }

    public function winner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function performances()
    {
        return $this->hasMany(Performance::class);
    }

    public function scopeCompleted(Builder $query): Builder
    {
        return $query->where('user_id', '!=', null);
    }
}
