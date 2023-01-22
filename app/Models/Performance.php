<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Performance extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'round_id',
        'duration',
    ];

    public function round()
    {
        return $this->belongsTo(Round::class);
    }

    public function combatant()
    {
        return $this->belongsTo(User::class);
    }
}
