<?php


namespace Sabt\Course\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Sabt\Category\Repositories\CategoryRepository;
use Sabt\Common\Responses\AjaxResponses;
use Sabt\Course\Http\Requests\CourseRequest;
use Sabt\Course\Models\Course;
use Sabt\Course\Models\Season;
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
        $this->authorize('index', Course::class);
        $courses = $this->courseRepository->all();
        return view('Course::index', compact('courses'));

    }

    public function show(Course $course)
    {

        $this->authorize('show', $course);
        return view('Course::show',compact('course'));
    }

    public function create(UserRepository $userRepository, CategoryRepository $categoryRepository)
    {
        $this->authorize('create', Course::class);
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
        $this->authorize('edit', $course);
        $teachers   = $userRepository->getTeachers();
        $categories = $categoryRepository->all();
        return view('Course::edit', compact('teachers', 'categories', 'course'));
    }


    public function update(Course $course, CourseRequest $request)
    {
        $this->authorize('edit', $course);
        if ($request->hasFile('image'))
        {
            if ($course->banner)
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
        $this->authorize('delete', $course);

        if ($course->banner)
        {
            $course->banner->delete();
        }
        $this->courseRepository->delete($course);
        return AjaxResponses::success();
    }

    public function accept(Course $course)
    {
        $this->authorize('change_confirmation_status', Course::class);

        if ($this->courseRepository->updateConfirmationStatus($course, Course::CONFIRMATION_STATUS_ACCEPTED))
        {
            return AjaxResponses::success();
        };
        return AjaxResponses::failed();
    }

    public function reject(Course $course)
    {
        $this->authorize('change_confirmation_status', Course::class);

        if ($this->courseRepository->updateConfirmationStatus($course, Course::CONFIRMATION_STATUS_REJECTED))
        {
            return AjaxResponses::success();
        };
        return AjaxResponses::failed();
    }

    public function lock(Course $course)
    {
        $this->authorize('change_confirmation_status', Course::class);

        if ($this->courseRepository->updateStatus($course, Course::STATUS_LOCKED))
        {
            return AjaxResponses::success();
        };
        return AjaxResponses::failed();
    }
}
