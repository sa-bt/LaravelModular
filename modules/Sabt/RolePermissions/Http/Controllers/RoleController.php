<?php


namespace Sabt\RolePermissions\Http\Controllers;


use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        $roles=Role::all();
        return view('RolePermissions::index',compact('roles'));
 }
}
