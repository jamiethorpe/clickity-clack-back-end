<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Round extends Model
{
    use HasFactory;

    protected $fillable = [
        'showdown_id',
        'user_id',
        'technique',
    ];

    public function showdown()
    {
        return $this->belongsTo(Showdown::class);
    }

    public function winner()
    {
        return $this->belongsTo(User::class);
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
