<?php


namespace Sabt\Course\Http\Controllers;


use App\Http\Controllers\Controller;
use Sabt\Category\Repositories\CategoryRepository;
use Sabt\Course\Http\Requests\CourseStoreRequest;
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

    public function store(CourseStoreRequest $request)
    {
        $request->request->add(['banner_id' => MediaUploadService::upload($request->file('image'))->id]);
        $this->courseRepository->store($request);
        return redirect()->route('courses.index');
    }
}
