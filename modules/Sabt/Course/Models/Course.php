<?php

namespace Sabt\Course\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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

    static $statuses = [self::STATUS_COMPLETED, self::STATUS_NOT_COMPLETED, self::STATUS_LOCKED];


    protected $guarded = [];

    public function banner()
    {
        return $this->belongsTo(Media::class , 'banner_id');
    }



    public function teacher()
    {
        return $this->belongsTo(User::class,'teacher_id');
    }
}
