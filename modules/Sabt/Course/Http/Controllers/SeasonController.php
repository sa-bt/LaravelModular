<?php


namespace Sabt\Course\Http\Controllers;


use App\Http\Controllers\Controller;
use Sabt\Course\Http\Requests\SeasonRequest;
use Sabt\Course\Repositories\SeasonRepository;

class SeasonController extends Controller
{

    private $seasonRepository;

    public function __construct(SeasonRepository $seasonRepository)
    {

        $this->seasonRepository = $seasonRepository;
    }

    public function index()
    {
    }


    public function store(SeasonRequest $request)
    {
        $this->seasonRepository->create($request);
        newFeedback();
        return back();
    }

}
