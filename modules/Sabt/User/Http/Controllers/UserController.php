<?php


namespace Sabt\User\Http\Controllers;


use App\Http\Controllers\Controller;
use Sabt\RolePermissions\Repositories\RoleRepository;
use Sabt\User\Http\Requests\AddRoleRequest;
use Sabt\User\Models\User;
use Sabt\User\Repositories\UserRepository;

class UserController extends Controller
{
    private $userRepository;
    private $roleRepository;

    public function __construct(UserRepository $userRepository, RoleRepository $roleRepository)
    {
        $this->userRepository = $userRepository;
        $this->roleRepository = $roleRepository;
    }

    public function index()
    {
        $this->authorize('view' , User::class);
        $roles = $this->roleRepository->all();
        $users = $this->userRepository->paginate();
        return view('User::Admin.index', compact('users', 'roles'));
    }

    public function addRole(AddRoleRequest $request, User $user)
    {
        $this->authorize('addRole' , User::class);
        $user->assignRole($request->role);
        return back();
    }
}
