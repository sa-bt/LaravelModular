<?php


namespace Sabt\Course\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Http\Middleware\Authenticate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Sabt\Common\Responses\AjaxResponses;
use Sabt\Course\Http\Requests\LessonRequest;
use Sabt\Course\Http\Requests\SeasonRequest;
use Sabt\Course\Models\Course;
use Sabt\Course\Models\Lesson;
use Sabt\Course\Models\Season;
use Sabt\Course\Repositories\LessonRepository;
use Sabt\Course\Repositories\SeasonRepository;
use Sabt\Media\Services\MediaUploadService;

class LessonController extends Controller
{

    private $seasonRepository;
    private $lessonRepository;

    public function __construct(SeasonRepository $seasonRepository, LessonRepository $lessonRepository)
    {
        $this->lessonRepository = $lessonRepository;
        $this->seasonRepository = $seasonRepository;
    }

    public function index()
    {
    }


    public function create(Course $course)
    {
        $this->authorize('createLesson', $course);
        $seasons = $this->seasonRepository->getAcceptSeasons($course->id);
        return view('Course::lessons.create', compact('seasons', 'course'));
    }

    public function store(Course $course, LessonRequest $request)
    {
        $this->authorize('createLesson', $course);
        $request->request->add(["media_id" => MediaUploadService::upload($request->file('lessonFile'))->id]);
        $this->lessonRepository->create($course->id, $request);
        newFeedback();
        return view('Course::show', compact('course'));
    }

    public function edit(Course $course, Lesson $lesson)
    {
        $this->authorize('edit', $lesson);
        $seasons = $this->seasonRepository->getAcceptSeasons($course->id);
        return view('Course::lessons.edit', compact('course', 'lesson', 'seasons'));
    }

    public function update(Course $course, Lesson $lesson, LessonRequest $request)
    {
        $this->authorize('edit', $lesson);
        if ($request->hasFile('lessonFile')) {
            if ($lesson->media) $lesson->media->delete();
            $request->request->add(['media_id' => MediaUploadService::upload($request->file('lessonFile'))->id]);
        } else {
            $request->request->add(['media_id' => $lesson->media_id]);
        }
        $this->lessonRepository->edit($lesson, $request);
        newFeedback();
        return redirect(route("courses.show", $course->id));
    }

    public function destroy(Course $course, Lesson $lesson)
    {
        $this->authorize('delete', $lesson);
        if ($lesson->media) {
            $lesson->media->delete();
        }
        $this->lessonRepository->delete($lesson);
        return AjaxResponses::success();
    }

    public function deleteMultiple(Request $request)
    {
        $ids = explode(',', $request->ids);
        foreach ($ids as $id) {
            $lesson = $this->lessonRepository->findById($id);
            $this->authorize('delete', $lesson);
            if ($lesson->media) {
                $lesson->media->delete();
            }
            $this->lessonRepository->delete($lesson);
        }
        newFeedback();
        return back();
    }

    public function accept(Course $course, Lesson $lesson)
    {
        $this->authorize('change_status', $lesson);

        if ($this->lessonRepository->updateConfirmationStatus($lesson, Lesson::CONFIRMATION_STATUS_ACCEPTED)) {
            return AjaxResponses::success();
        };
        return AjaxResponses::failed();
    }

    public function reject(Course $course, Lesson $lesson)
    {
        $this->authorize('change_status', $lesson);

        if ($this->lessonRepository->updateConfirmationStatus($lesson, Lesson::CONFIRMATION_STATUS_REJECTED)) {
            return AjaxResponses::success();
        };
        return AjaxResponses::failed();
    }

    public function rejectMultiple(Request $request, Course $course)
    {
        $this->authorize('change_status_all',Lesson::class);
        $ids = explode(',', $request->ids);
        $this->lessonRepository->updateStatusAllLessons($ids, Lesson::CONFIRMATION_STATUS_REJECTED);
        newFeedback();
        return back();
    }
    public function acceptMultiple(Request $request, Course $course)
    {
        $this->authorize('change_status_all',Lesson::class);
        $ids = explode(',', $request->ids);
        $this->lessonRepository->updateStatusAllLessons($ids, Lesson::CONFIRMATION_STATUS_ACCEPTED);
        newFeedback();
        return back();
    }

    public function lock(Course $course, Lesson $lesson)
    {
//        $this->authorize('change_status', Season::class);
//
//        if ($this->seasonRepository->updateStatus($lesson, Season::STATUS_LOCKED))
//        {
//            return AjaxResponses::success();
//        };
//        return AjaxResponses::failed();
    }
}
