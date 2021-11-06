<?php

namespace Sabt\Course\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Sabt\User\Models\User;

class CoursePolicy
{
    use HandlesAuthorization;


    public function __construct()
    {
        //
    }
}
