<?php


namespace Sabt\Course\Http\Controllers;


use App\Http\Controllers\Controller;
use Sabt\Category\Repositories\CategoryRepository;
use Sabt\Course\Http\Requests\CourseStoreRequest;
use Sabt\User\Repositories\UserRepository;

class CourseController extends Controller
{
    public function index()
    {
}

    public function create(UserRepository $userRepository, CategoryRepository $categoryRepository)
    {
        $teachers=$userRepository->getTeachers();
        $categories=$categoryRepository->all();
        return view('Course::create',compact('teachers','categories'));
}

    public function store(CourseStoreRequest $request)
    {
dd(11);
}
}
