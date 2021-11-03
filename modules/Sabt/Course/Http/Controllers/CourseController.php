<?php


namespace Sabt\Course\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Sabt\Category\Repositories\CategoryRepository;
use Sabt\Category\Responses\AjaxResponses;
use Sabt\Course\Http\Requests\CourseRequest;
use Sabt\Course\Models\Course;
use Sabt\Course\Repositories\CourseRepository;
use Sabt\Media\Services\MediaUploadService;
use Sabt\User\Repositories\UserRepository;

class CourseController extends Controller
{
    /**
     * @var CourseRepository
     */
    private $courseRepository;

    public function __construct(CourseRepository $courseRepository)
    {

        $this->courseRepository = $courseRepository;
    }

    public function index()
    {
        $courses = $this->courseRepository->all();
        return view('Course::index', compact('courses'));

    }

    public function create(UserRepository $userRepository, CategoryRepository $categoryRepository)
    {
        $teachers   = $userRepository->getTeachers();
        $categories = $categoryRepository->all();
        return view('Course::create', compact('teachers', 'categories'));
    }

    public function store(CourseRequest $request)
    {
        $request->request->add(['banner_id' => MediaUploadService::upload($request->file('image'))->id]);
        $this->courseRepository->store($request);
        return redirect()->route('courses.index');
    }

    public function edit(Course $course, UserRepository $userRepository, CategoryRepository $categoryRepository)
    {
        $teachers   = $userRepository->getTeachers();
        $categories = $categoryRepository->all();
        return view('Course::edit', compact('teachers', 'categories', 'course'));
    }


    public function update(Course $course, CourseRequest $request)
    {
        if ($request->hasFile('image'))
        {
            $course->banner->delete();
            $request->request->add(['banner_id' => MediaUploadService::upload($request->file('image'))->id]);
        }
        else
        {
            $request->request->add(['banner_id' => $course->banner_id]);
        }
        $this->courseRepository->update($course, $request);
        return redirect()->route('courses.index');
    }

    public function destroy(Course $course)
    {
        if ($course->banner)
        {
            $course->banner->delete();
        }
        $this->courseRepository->delete($course);
        return AjaxResponses::success();
    }

    public function accept(Course $course)
    {
        if ($this->courseRepository->updateConfirmationStatus($course, Course::CONFIRMATION_STATUS_ACCEPTED))
        {
            return AjaxResponses::success();
        };
        return AjaxResponses::failed();
    }

    public function reject(Course $course)
    {
        if ($this->courseRepository->updateConfirmationStatus($course, Course::CONFIRMATION_STATUS_REJECTED))
        {
            return AjaxResponses::success();
        };
        return AjaxResponses::failed();
    }

    public function lock(Course $course)
    {
        if ($this->courseRepository->updateStatus($course, Course::STATUS_LOCKED))
        {
            return AjaxResponses::success();
        };
        return AjaxResponses::failed();
    }
}
