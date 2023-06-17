<?php

namespace App\Models;


use App\Models\Profile;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'banned_until',
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
        'password' => 'hashed',
    ];

    public function profile(): HasOne
    {
        return $this->hasOne(Profile::class);
    }

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'role_user', 'user_id', 'role_id');
    }

    public function isOnline() : bool
    {

        if (!$this->last_activity) {
            return false;
        }
        $lastActivity =  new Carbon($this->last_activity);
        return $lastActivity->diffInMinutes(now()) < 5;
    }

    public function updateLastActivity()
    {
        $this->last_activity = now();
        $this->save();
    }

    public function thread() : HasMany
    {
        return $this->hasMany(Thread::class);
    }

    public function threadFollow() : BelongsToMany
    {
        return $this->belongsToMany(Thread::class, 'follow_threads');
    }

    public function reaction() : HasMany
    {
        return $this->hasMany(Reaction::class);
    }

    public function category() : HasMany
    {
        return $this->hasMany(Category::class);
    }


    public function imageTmp() : HasMany
    {
        return $this->hasMany(ImageTmp::class);
    }
}
