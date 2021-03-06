<?php


namespace Sabt\Common\Responses;


use Illuminate\Http\Response;

class AjaxResponses
{
    public static function success()
    {
        return response()->json(["message" => "عملیات با موفقیت انجام شد"], Response::HTTP_OK);
    }
    public static function failed()
    {
        return response()->json(["message" => "عملیات با مشکل روبرو شد"], Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}
