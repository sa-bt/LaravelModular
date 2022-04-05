<?php
namespace Sabt\Front\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Sabt\Course\Models\Course;
use Sabt\Course\Repositories\CourseRepository;
use Sabt\Course\Repositories\LessonRepository;

class FrontController extends Controller
{
    public function index()
    {
        return view('Front::index');
    }

    public function singleCourse($slug,CourseRepository $courseRepository,LessonRepository $lessonRepository)
    {
        $courseId=$this->extractId($slug,'c');
        $course=$courseRepository->findOrFailById($courseId);
        $lessons=$lessonRepository->getAcceptedLessons($course->id);

        if (request()->lesson){
            $lesson=$lessonRepository->getLesson($courseId,$this->extractId($slug,'l'));
        }else{
            $lesson=$lessonRepository->getFirstLesson($courseId);
        }
        return view('Front::singleCourse',compact('course','lessons','lesson'));
    }

    public function extractId($slug,$key)
    {
        return Str::before(Str::after($slug,$key.'-'),'-');
    }
}