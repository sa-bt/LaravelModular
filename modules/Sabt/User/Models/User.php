<?php

namespace Sabt\User\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Sabt\Course\Models\Course;
use Sabt\Course\Models\Season;
use Sabt\Media\Models\Media;
use Sabt\User\Database\Factories\UserFactory;
use Sabt\User\Notifications\ResetPasswordRequestNotification;
use Sabt\User\Notifications\VerifyEmailNotification;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    const ACTIVE_STATUS = "active";
    const INACTIVE_STATUS = "inactive";
    const BAN_STATUS = "ban";

    public static $statuses = [
        self::ACTIVE_STATUS,
        self::INACTIVE_STATUS,
        self::BAN_STATUS
    ];

    protected $guarded    = [];
    protected $primaryKey = 'id';

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected static function newFactory()
    {
        return UserFactory::new();
    }

    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmailNotification());
    }

    public function sendResetPasswordRequestNotification()
    {
        $this->notify(new ResetPasswordRequestNotification());
    }

    public function image()
    {
        return $this->belongsTo(Media::class, 'image_id');
    }

    public function teaches()
    {
        return $this->hasMany(Course::class, 'teacher_id');
    }

    public function profilePath()
    {
        return $this->username ? route('viewProfile', $this->username) : route('viewProfile', 'username');
    }

    
    public function seasons()
    {
        return $this->hasMany(Season::class);
    }
}
