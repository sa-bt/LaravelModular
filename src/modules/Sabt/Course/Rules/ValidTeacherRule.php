<?php


namespace Sabt\Course\Rules;


use Illuminate\Contracts\Validation\Rule;
use Sabt\User\Repositories\UserRepository;

class ValidTeacherRule implements Rule
{

    public function passes($attribute, $value)
    {
        return resolve(UserRepository::class)->findById($value)->hasPermissionTo('teach');
    }


    public function message()
    {
        return "مدرسی با این مشخصات وجود ندارد.";
    }
}
