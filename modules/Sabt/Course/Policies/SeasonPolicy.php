<?php

namespace Sabt\Course\Policies;

use Sabt\Course\Models\Season;
use Illuminate\Auth\Access\HandlesAuthorization;
use Sabt\User\Models\User;

class SeasonPolicy
{
    use HandlesAuthorization;
public function __construct()
{
    dd(6);
}

    public function viewAny(User $user)
    {
        //
    }

    public function view(User $user, Season $season)
    {
        //
    }


    public function create(User $user)
    {
        dd(22);
    }


    public function update(User $user, Season $season)
    {
        //
    }

    public function delete(User $user, Season $season)
    {
        //
    }

    public function restore(User $user, Season $season)
    {
        //
    }

    public function forceDelete(User $user, Season $season)
    {
        //
    }
}
