<?php


namespace Sabt\Discount\Http\Controllers;


use App\Http\Controllers\Controller;
use Sabt\Common\Responses\AjaxResponses;
use Sabt\Course\Models\Course;
use Sabt\Course\Repositories\CourseRepository;
use Sabt\Discount\Http\Requests\DiscountRequest;
use Sabt\Discount\Models\Discount;
use Sabt\Discount\Repositories\DiscountRepo;
use Sabt\Discount\Services\DiscountService;

class DiscountController extends Controller
{
    public function index(CourseRepository $courseRepo, DiscountRepo $repo)
    {
        $this->authorize("manage", Discount::class);
        $discounts = $repo->paginateAll();
        $courses = $courseRepo->all(Course::CONFIRMATION_STATUS_ACCEPTED);
        return view("Discounts::index", compact("courses", "discounts"));
    }

    public function store(DiscountRequest $request, DiscountRepo $repo)
    {
        $this->authorize("manage", Discount::class);
        $repo->store($request->all());
        newFeedback();
        return back();
    }

    public function edit(Discount $discount, CourseRepository $courseRepo)
    {
        $this->authorize("manage", Discount::class);
        $courses = $courseRepo->all(Course::CONFIRMATION_STATUS_ACCEPTED);
        return view("Discounts::edit", compact("discount", "courses"));
    }

    public function update(Discount $discount, DiscountRequest $request, DiscountRepo $repo)
    {
        $this->authorize("manage", Discount::class);
        $repo->update($discount->id, $request->all());
        newFeedback();
        return redirect()->route("discounts.index");

    }

    public function destroy(Discount $discount)
    {
        $this->authorize("manage", Discount::class);
        $discount->delete();
        return AjaxResponses::SuccessResponse();
    }

    public function check($code, Course $course, DiscountRepo $repo)
    {

        $discount = $repo->getValidDiscountByCode($code, $course->id);
        if ($discount){
            $discountAmount = DiscountService::calculateDiscountAmount($course->getFinalPrice(), $discount->percent);
            $discountPercent = $discount->percent;
            $response = [
                "status" => "valid",
                "payableAmount" => $course->getFinalPrice() - $discountAmount,
                "discountAmount" => $discountAmount,
                "discountPercent" => $discountPercent
            ];
            return response()->json($response);
        }

        return \response()->json([
            "status" => "invalid"
        ])->setStatusCode(422);
    }
}
