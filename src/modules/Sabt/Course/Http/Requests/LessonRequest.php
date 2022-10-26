<?php

namespace Sabt\Course\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Sabt\Course\Rules\ValidSeason;
use Sabt\Media\Services\MediaUploadService;

class LessonRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
       $rules= [
            "title"      => "required|min:3|max:190",
            "slug"       => "nullable|min:3|max:190|unique:courses,slug",
            "number"     => "nullable|numeric",
            "time"       => "nullable|numeric|min:0|max:255",
            "season_id"  => ["nullable",new ValidSeason()],
            "free"       => 'required|boolean',
            "lessonFile" => "required|file|mimes:avi,mkv,mp4,zip,rar",
        ];

        if (request()->method === 'PUT')
        {
            $rules['lessonFile'] = "nullable|mimes:".MediaUploadService::getExtensions();
        }
        return $rules;
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
