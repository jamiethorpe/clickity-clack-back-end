<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasUuids;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'email_verified_at',
        'remember_token',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Relationships

    public function showdowns(): BelongsToMany
    {
        return $this->belongsToMany(Showdown::class, 'showdowns_users')->withTimestamps();
    }

    public function wins()
    {
        return $this->showdowns()->completed()->where('showdowns.user_id', $this->id);
    }

    public function losses()
    {
        return $this->showdowns()->completed()->whereNot('showdowns.user_id',  $this->id);
    }

    /**
     * @return float|int
     */
    public function winRate(): float|int
    {
        return $this->losses()->count() > 0
            ? round($this->wins()->count() / $this->showdowns()->count() * 100, 2)
            : ($this->wins()->count() > 0 ? 100 : 0);
    }
}
