<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'username',
        'password',
        'profile_photo',
        'about_me',
        'status',
        'is_profile_complete',
        'last_login_at',
        'registered_at',
        'is_private_profile'
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
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_profile_complete'=>'boolean'
        ];
    }



    public function followers(): BelongsToMany
    {
        return $this->belongsToMany(__CLASS__, 'followed_users', 'followed_id', 'follower_id');
    }


    public function following(): BelongsToMany
    {
        return $this->belongsToMany(__CLASS__, 'followed_users', 'follower_id', 'followed_id');
    }
}
