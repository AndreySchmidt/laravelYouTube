<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

use App\Models\Channel;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    //channel - название метода (при выдаче пользователя, будет тянуть отношение канала)
    // protected $with = ['channel'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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

    public function channel()
    {
        // отношение один к одному
        // return $this->hasOne(Channel::class, 'user_id', 'id');
        return $this->hasOne(Channel::class);
    }

    public function scopeSearch($query, ?string $text)
    {
        return $query->where(function ($query) use ($text)
                {
                    $query->where('name', 'like', "%$text%")
                    ->orWhere('email', 'like', "%$text%");
                });
    }
}
