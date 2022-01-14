<?php


namespace Sabt\Course\Repositories;


use Sabt\Course\Models\Course;
use Sabt\Course\Models\Lesson;
use Sabt\RolePermissions\Models\Permission;

class CourseRepository
{
    public function all()
    {
        if (auth()->user()->hasPermissionTo(Permission::MANAGE_COURSES_OWN_PERMISSION))
            return Course::query()->where('teacher_id', '=', auth()->id());
        return Course::all();
    }

    public function findById($id)
    {
        return Course::query()->firstOrFail($id);
    }

    public function store($values)
    {
        return Course::create([
            "teacher_id" => $values->teacher_id,
            "category_id" => $values->category_id,
            "title" => $values->title,
            "slug" => $values->slug,
            "priority" => $values->priority,
            "price" => $values->price,
            "percent" => $values->percent,
            "type" => $values->type,
            "status" => $values->status,
            "banner_id" => $values->banner_id,
            "body" => $values->body,
        ]);
    }

    public function delete($course)
    {
        return $course->delete();
    }

    public function update($course, $values)
    {
        return $course->update([
            "teacher_id" => $values->teacher_id,
            "category_id" => $values->category_id,
            "title" => $values->title,
            "slug" => $values->slug,
            "priority" => $values->priority,
            "price" => $values->price,
            "percent" => $values->percent,
            "type" => $values->type,
            "status" => $values->status,
            "banner_id" => $values->banner_id,
            "body" => $values->body,
        ]);
    }

    public function updateConfirmationStatus($course, $status)
    {
        return $course->update([
            'confirmation_status' => $status
        ]);
    }

    public function updateStatus(Course $course, $status)
    {
        return $course->update([
            'status' => $status
        ]);
    }

    public function getCourseByTeacherId(int $id)
    {
        return Course::query()->where('teacher_id', $id)->get();
    }

    public function latestCourses()
    {
        return Course::query()
            ->where('confirmation_status', '=', Course::CONFIRMATION_STATUS_ACCEPTED)
            ->latest()
            ->take(8)
            ->get();
    }

    public function getDuration($id)
    {
        return Lesson::query()
            ->where('course_id','=',$id)
            ->where("confirmation_status",'=',Lesson::CONFIRMATION_STATUS_ACCEPTED)
            ->sum('time');
    }
}
