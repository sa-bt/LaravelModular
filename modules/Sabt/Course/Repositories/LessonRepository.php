<?php


namespace Sabt\Course\Repositories;


use Sabt\Course\Models\Course;
use Sabt\Course\Models\Lesson;
use Sabt\Course\Models\Season;
use function PHPUnit\Framework\isInstanceOf;

class LessonRepository
{
    public function all()
    {
        return Season::all();
    }


    public function create($values)
    {
        return Lesson::create([
                                  "title"     => $values->title,
                                  "slug"     => $values->slug,
                                  "time"     => $values->time,
                                  "free"     => $values->free,
                                  "number"    => $this->generateNumber($values->course_id, $values->number),
                                  "course_id" => $values->course_id,
                                  "season_id" => $values->season_id,
                                  "media_id" => $values->media_id,
                                  "body"     => $values->body,
                                  "user_id"   => auth()->id()
                              ]);
    }

    public function delete($season)
    {
        return $season->delete();
    }

    public function edit($season, $values)
    {
        return $season->update([
                                   "title"  => $values->title,
                                   "number" => $this->generateNumber($season->course, $values->number),
                               ]);
    }


    public function updateStatus(Season $season, $status)
    {
        return $season->update([
                                   'status' => $status
                               ]);
    }

    private function generateNumber($course, $number)
    {
        $course = !$course instanceof Course ? Course::find($course) : $course;

        if (is_null($number))
        {
            $number = $course->seasons()->orderBy('number', 'desc')->firstOrNew([])->number ?: 0;
            $number++;
        }
        return $number;
    }

    public function updateConfirmationStatus($season, $status)
    {
        return $season->update([
                                   'confirmation_status' => $status
                               ]);
    }

}
