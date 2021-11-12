<?php


namespace Sabt\RolePermissions\Http\Controllers;


use App\Http\Controllers\Controller;
use Sabt\Category\Responses\AjaxResponses;
use Sabt\RolePermissions\Http\Requests\RoleUpdateRequest;
use Sabt\RolePermissions\Http\Requests\RoleStoreRequest;
use Sabt\RolePermissions\Models\Role;
use Sabt\RolePermissions\Repositories\PermissionRepository;
use Sabt\RolePermissions\Repositories\RoleRepository;

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
        $this->authorize('index', Role::class);
        $permissions = $this->permissionRepository->all();
        $roles       = $this->roleRepository->all();
        return view('RolePermissions::index', compact('permissions', 'roles'));
    }

    public function store(RoleStoreRequest $request)
    {
        $this->authorize('create', Role::class);
        $this->roleRepository->create($request);
        return redirect()->route('roles.index');
    }

    public function edit(Role $role)
    {
        $this->authorize('edit', Role::class);
        $permissions = $this->permissionRepository->all();
        return view('RolePermissions::edit', compact('role', 'permissions'));
    }

    public function update(RoleUpdateRequest $request, Role $role)
    {
        $this->authorize('edit', Role::class);
        $this->roleRepository->edit($role, $request);
        return redirect()->route('roles.index');
    }

    public function destroy(Role $role)
    {
        $this->authorize('delete', Role::class);
        $this->roleRepository->delete($role);
        return AjaxResponses::success();
    }
}
