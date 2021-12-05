<?php

namespace Sabt\Course\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Sabt\Course\Rules\ValidSeason;

class LessonRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            "title"      => "required|min:3|max:190",
            "slug"       => "nullable|min:3|max:190|unique:courses,slug",
            "number"     => "nullable|numeric",
            "time"       => "nullable|numeric|min:0|max:255",
            "season_id"  => [new ValidSeason()],
            "free"       => 'required|boolean',
            "lessonFile" => "required|file|mimes:avi,mkv,mp4,zip,rar",
        ];
    }

    public function attributes()
    {
        return [
            "slug"       => "عنوان انگلیسی",
            "number"     => "شماره",
            "free"       => "رایگان بودن",
            "lessonFile" => "فایل"
        ];
    }

}
