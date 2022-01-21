<?php
namespace Sabt\Front\Http\Controllers;

use App\Http\Controllers\Controller;
use Sabt\Course\Models\Course;

class FrontController extends Controller
{
    public function index()
    {
        return view('Front::index');
    }

    public function singleCourse(Course $course)
    {
        dd($course);
        return view('Front::singleCourse',compact('course'));
    }
}
