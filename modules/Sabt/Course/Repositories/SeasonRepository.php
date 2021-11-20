<?php


namespace Sabt\Course\Repositories;


use Sabt\Course\Models\Season;

class SeasonRepository
{
    public function all()
    {
        return Season::all();
    }

    public function create($values)
    {
        return Season::create([
                                  "title"       => $values->title,
                                  "number"        => $values->number,
                                  "course_id"        => $values->course_id,
                                  "user_id"        => auth()->id()
                              ]);
    }

    public function delete($season)
    {
        return $season->delete();
    }

    public function update($season, $values)
    {
        return $season->update([
                                   "teacher_id"  => $values->teacher_id,
                                   "category_id" => $values->category_id,
                                   "title"       => $values->title,
                                   "slug"        => $values->slug,
                                   "priority"    => $values->priority,
                                   "price"       => $values->price,
                                   "percent"     => $values->percent,
                                   "type"        => $values->type,
                                   "status"      => $values->status,
                                   "banner_id"   => $values->banner_id,
                                   "body"        => $values->body,
                               ]);
    }


    public function updateStatus(Season $season, $status)
    {
        return $season->update([
                                   'status' => $status
                               ]);
    }
}
