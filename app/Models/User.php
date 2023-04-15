<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Channel;
use App\Models\Comment;
// use Illuminate\Support\Arr;
use App\Traits\WithRelationships;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Hash;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Notifications\ResetPasswordNotification;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, WithRelationships;
    protected static $relationships = ['channel', 'comments'];

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
    
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    protected function password(): Attribute
    {
        return Attribute::make(
            set: fn(string $password) => Hash::make($password),
        );
    }

    protected static function booted()
    {
        static::deleting(fn (User $user) => $user->tokens()->delete());
    }

    public function sendPasswordResetNotification($token): void
    {
        $url = url(route('password.reset', [
            'token' => $token,
            'email' => $this->getEmailForPasswordReset(),
        ], false));

        // sudo ./vendor/bin/sail artisan make:notification ResetPasswordNotification
        $this->notify(new ResetPasswordNotification($url));
    }
}
