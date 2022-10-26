<?php

namespace Sabt\Course\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Sabt\Course\Database\Factories\SeasonFactory;
use Sabt\User\Models\User;

class Season extends Model
{
    use HasFactory;

    const CONFIRMATION_STATUS_ACCEPTED = 'accepted';
    const CONFIRMATION_STATUS_REJECTED = 'rejected';
    const CONFIRMATION_STATUS_PENDING = 'pending';
    public static $confirmationStatuses = [
        self::CONFIRMATION_STATUS_ACCEPTED,
        self::CONFIRMATION_STATUS_REJECTED,
        self::CONFIRMATION_STATUS_PENDING
    ];

    protected $guarded = [];


    protected static function newFactory()
    {
        return SeasonFactory::new();
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeOrderByNumber($query)
    {
        return $query->orderBy('number')->get();
    }
}
