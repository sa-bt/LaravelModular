<?php


namespace Sabt\Course\Rules;


use Illuminate\Contracts\Validation\Rule;
use Sabt\Course\Repositories\SeasonRepository;

class ValidSeason implements Rule
{

    public function passes($attribute, $value)
    {
        return resolve(SeasonRepository::class)->fetchAllSeason(request()->route('course')->id , $value);
    }


    public function message()
    {
        return "سرفصل وجود ندارد.";
    }
}
