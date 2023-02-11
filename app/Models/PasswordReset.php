<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PasswordReset extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'token',
    ];

    public function getLink()
    {
        return config('app.front_end_url') . '/password-reset/' . $this->token;
    }
}
