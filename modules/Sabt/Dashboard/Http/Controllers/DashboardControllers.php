<?php


namespace Sabt\Dashboard\Http\Controllers;


use App\Http\Controllers\Controller;

class DashboardControllers extends Controller
{
    public function index()
    {
        return view('Dashboard::index');
    }
}
