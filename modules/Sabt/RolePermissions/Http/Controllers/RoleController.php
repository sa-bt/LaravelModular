<?php


namespace Sabt\RolePermissions\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        $permissions=Permission::all();
        $roles=Role::all();
        return view('RolePermissions::index',compact('permissions','roles'));
 }

    public function store(Request $request)
    {
        dd($request->all());
 }
}
