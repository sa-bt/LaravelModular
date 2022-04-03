<?php

namespace Sabt\Course\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;
use Sabt\Course\Database\Factories\LessonFactory;
use Sabt\Course\Database\Factories\SeasonFactory;
use Sabt\Media\Models\Media;
use Sabt\User\Models\User;

class Lesson extends Model
{
    use HasFactory;

    const CONFIRMATION_STATUS_ACCEPTED = 'accepted';
    const CONFIRMATION_STATUS_REJECTED = 'rejected';
    const CONFIRMATION_STATUS_PENDING = 'pending';
    const CONFIRMATION_STATUS_LOCKED = 'locked';
    public static $confirmationStatuses = [
        self::CONFIRMATION_STATUS_ACCEPTED,
        self::CONFIRMATION_STATUS_REJECTED,
        self::CONFIRMATION_STATUS_PENDING,
        self::CONFIRMATION_STATUS_LOCKED
    ];

    protected $guarded = [];


    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function season()
    {
        return $this->belongsTo(Season::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function media()
    {
        return $this->belongsTo(Media::class);
    }

    public function scopeOrderByNumber($query)
    {
        return $query->orderBy('number')->get();
    }

    public function getAccessAttribute()
    {
        return $this->free ? "همه" : "محدود";
    }
//    public function getSeasonAttribute()
//    {
//        return $this->season ? $this->season->title : "";
//    }

    protected static function newFactory()
    {
        return LessonFactory::new();
    }

    public function path()
    {
        return $this->course->path().'?lesson=l-'.$this->id.'-'.$this->slug;
    }

    public function downloadLink()
    {
        return URL::temporarySignedRoute('media.download',now()->addDay(),['media'=>$this->media_id]);
//        return route('media.download',$this->media_id)
    }
}
