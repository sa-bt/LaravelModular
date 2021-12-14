<?php


namespace Sabt\Course\Http\Controllers;


use App\Http\Controllers\Controller;
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
//        $this->authorize('createSeason', Course::findOrFail($request->course_id));
        $seasons = $this->seasonRepository->getAcceptSeasons($course->id);
        return view('Course::lessons.create', compact('seasons', 'course'));
    }

    public function store(Course $course, LessonRequest $request)
    {
//        $this->authorize('createSeason', Course::findOrFail($request->course_id));
        $request->request->add(["media_id" => MediaUploadService::upload($request->file('lessonFile'))->id]);
        $this->lessonRepository->create($course->id, $request);
        newFeedback();
        return view('Course::show', compact('course'));
    }

    public function edit(Course $course, Lesson $lesson)
    {
//        $this->authorize('edit', $lesson);
//        return view('Course::seasons.edit', compact('lesson'));
    }

    public function update(Course $course, Lesson $lesson, SeasonRequest $request)
    {
        $this->authorize('edit', $lesson);
        $this->lessonRepository->edit($lesson, $request);
        newFeedback();
        return redirect(route("courses.show", $lesson->course->id));
    }

    public function destroy(Course $course, Lesson $lesson)
    {
//        $this->authorize('delete', $lesson);
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
        return back();
    }

    public function accept(Course $course, Lesson $lesson)
    {
//        $this->authorize('change_confirmation_status', $lesson);
//
//        if ($this->seasonRepository->updateConfirmationStatus($lesson, Season::CONFIRMATION_STATUS_ACCEPTED))
//        {
//            return AjaxResponses::success();
//        };
//        return AjaxResponses::failed();
    }

    public function reject(Course $course, Lesson $lesson)
    {
//        $this->authorize('change_confirmation_status', $lesson);
//
//        if ($this->seasonRepository->updateConfirmationStatus($lesson, Season::CONFIRMATION_STATUS_REJECTED))
//        {
//            return AjaxResponses::success();
//        };
//        return AjaxResponses::failed();
    }

    public function lock(Course $course, Lesson $lesson)
    {
//        $this->authorize('change_confirmation_status', Season::class);
//
//        if ($this->seasonRepository->updateStatus($lesson, Season::STATUS_LOCKED))
//        {
//            return AjaxResponses::success();
//        };
//        return AjaxResponses::failed();
    }
}
