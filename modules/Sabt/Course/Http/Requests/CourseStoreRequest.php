<?php

namespace Sabt\Course\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Sabt\Course\Models\Course;

class CourseStoreRequest extends FormRequest
{

    public function authorize()
    {
        return auth()->check() == true;
    }


    public function rules()
    {
        return [
            "title"       => "required|min:3|max:190",
            "slug"        => "required|min:3|max:190|unique:courses,slug",
            "priority"    => "nullable|numeric",
            "price"       => "required|numeric|min:0|max:1000000",
            "percent"     => "required|numeric|min:0|max:100",
            "teacher_id"  => "required|exists:users,id",
            "type"        => ["required", Rule::in(Course::$types)],
            "status"      => ["required", Rule::in(Course::$statuses)],
            "category_id" => "required|exists:categories,id",
            "image"       => "required|mimes:jpg,png,jpeg",
        ];
    }
}
