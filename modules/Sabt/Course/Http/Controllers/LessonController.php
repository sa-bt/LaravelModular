<?php


namespace Sabt\Course\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Sabt\Common\Responses\AjaxResponses;
use Sabt\Course\Http\Requests\LessonRequest;
use Sabt\Course\Http\Requests\SeasonRequest;
use Sabt\Course\Models\Course;
use Sabt\Course\Models\Season;
use Sabt\Course\Repositories\LessonRepository;
use Sabt\Course\Repositories\SeasonRepository;

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
        $this->lessonRepository->create($request);
        newFeedback();
        return back();
    }

    public function edit(Season $season)
    {
        $this->authorize('edit', $season);
        return view('Course::seasons.edit', compact('season'));
    }

    public function update(Season $season, SeasonRequest $request)
    {
        $this->authorize('edit', $season);
        $this->seasonRepository->edit($season, $request);
        newFeedback();
        return redirect(route("courses.show", $season->course->id));
    }

    public function destroy(Season $season)
    {
        $this->authorize('delete', $season);
        $this->seasonRepository->delete($season);
        return AjaxResponses::success();
    }

    public function accept(Season $season)
    {
        $this->authorize('change_confirmation_status', $season);

        if ($this->seasonRepository->updateConfirmationStatus($season, Season::CONFIRMATION_STATUS_ACCEPTED))
        {
            return AjaxResponses::success();
        };
        return AjaxResponses::failed();
    }

    public function reject(Season $season)
    {
        $this->authorize('change_confirmation_status', $season);

        if ($this->seasonRepository->updateConfirmationStatus($season, Season::CONFIRMATION_STATUS_REJECTED))
        {
            return AjaxResponses::success();
        };
        return AjaxResponses::failed();
    }

    public function lock(Season $season)
    {
        $this->authorize('change_confirmation_status', Season::class);

        if ($this->seasonRepository->updateStatus($season, Season::STATUS_LOCKED))
        {
            return AjaxResponses::success();
        };
        return AjaxResponses::failed();
    }
}
