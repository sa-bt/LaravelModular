<?php


namespace Sabt\Course\Repositories;


use Sabt\Course\Models\Course;

class CourseRepository
{
    public function all()
    {
        return Course::all();
    }

    public function store($values)
    {
        return Course::create([
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
}
