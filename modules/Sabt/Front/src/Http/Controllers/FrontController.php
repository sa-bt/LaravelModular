<?php
namespace Sabt\Front\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Sabt\Course\Models\Course;
use Sabt\Course\Repositories\CourseRepository;

class FrontController extends Controller
{
    public function index()
    {
        return view('Front::index');
    }

    public function singleCourse($slug,CourseRepository $courseRepository)
    {
        $courseId=Str::before(Str::after($slug,'c-'),'-');
        $course=$courseRepository->findOrFailById($courseId);
        return view('Front::singleCourse',compact('course'));
    }
}
