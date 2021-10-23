<?php


namespace Sabt\RolePermissions\Http\Controllers;


use App\Http\Controllers\Controller;
use Sabt\Category\Responses\AjaxResponses;
use Sabt\RolePermissions\Http\Requests\RoleUpdateRequest;
use Illuminate\Http\Request;
use Sabt\RolePermissions\Http\Requests\RoleStoreRequest;
use Sabt\RolePermissions\Repositories\PermissionRepository;
use Sabt\RolePermissions\Repositories\RoleRepository;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    private $roleRepository;
    private $permissionRepository;

    public function __construct(RoleRepository $roleRepository, PermissionRepository $permissionRepository)
    {
        $this->roleRepository       = $roleRepository;
        $this->permissionRepository = $permissionRepository;
    }

    public function index()
    {
        $permissions = $this->permissionRepository->all();
        $roles       = $this->roleRepository->all();
        return view('RolePermissions::index', compact('permissions', 'roles'));
    }

    public function store(RoleStoreRequest $request)
    {
         $this->roleRepository->create($request);
         return redirect()->route('roles.index');
    }

    public function edit(Role $role)
    {
        $permissions = $this->permissionRepository->all();
        return view('RolePermissions::edit', compact('role','permissions'));
    }

    public function update(RoleUpdateRequest $request, Role $role)
    {
        $this->roleRepository->edit($role,$request);
        return redirect()->route('roles.index');
    }

    public function destroy(Role $role)
    {
        $this->roleRepository->delete($role);
        return AjaxResponses::success();
    }
}
