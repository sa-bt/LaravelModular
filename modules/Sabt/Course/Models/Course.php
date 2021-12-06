<?php

namespace Sabt\Course\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Sabt\Category\Models\Category;
use Sabt\Course\Database\Factories\CourseFactory;
use Sabt\Media\Models\Media;
use Sabt\User\Models\User;

class Course extends Model
{
    use HasFactory;

    const TYPE_FREE = 'free';
    const TYPE_CASH = 'cash';
    static $types = [self::TYPE_FREE, self::TYPE_CASH];

    const STATUS_COMPLETED = 'completed';
    const STATUS_NOT_COMPLETED = 'not-completed';
    const STATUS_LOCKED = 'locked';
    static $statuses = [
        self::STATUS_COMPLETED,
        self::STATUS_NOT_COMPLETED,
        self::STATUS_LOCKED
    ];

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
        return CourseFactory::new();
    }

    public function banner()
    {
        return $this->belongsTo(Media::class, 'banner_id');
    }


    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function seasons()
    {
        return $this->hasMany(Season::class);
    }

    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }
}
