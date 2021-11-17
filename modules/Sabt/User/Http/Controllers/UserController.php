<?php


namespace Sabt\User\Http\Controllers;


use App\Http\Controllers\Controller;
use Sabt\Common\Responses\AjaxResponses;
use Sabt\Media\Services\MediaUploadService;
use Sabt\RolePermissions\Models\Role;
use Sabt\RolePermissions\Repositories\RoleRepository;
use Sabt\User\Http\Requests\AddRoleRequest;
use Sabt\User\Http\Requests\UpdateUserPhoto;
use Sabt\User\Http\Requests\UpdateUserRequest;
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
        $this->authorize('view', User::class);
        $roles = $this->roleRepository->all();
        $users = $this->userRepository->paginate();
        return view('User::Admin.index', compact('users', 'roles'));
    }

    public function edit(User $user)
    {
        $this->authorize('edit', User::class);
        return view('User::Admin.edit', compact('user'));
    }


    public function update(UpdateUserRequest $request, User $user)
    {
        $this->authorize('edit', User::class);
        if ($request->hasFile('image'))
        {
            if ($user->image)
                $user->image->delete();
            $request->request->add(['image_id' => MediaUploadService::upload($request->file('image'))->id]);
        }
        else
        {
            $request->request->add(['image_id' => $user->image_id]);
        }
        $this->userRepository->update($user, $request);
        newFeedback();

        return back();
    }

    public function destroy(User $user)
    {
        $this->authorize('delete', User::class);
        $this->userRepository->delete($user);
        return AjaxResponses::success();
    }

    public function editProfile()
    {
        return view('User::Admin.profile');
    }

    public function addRole(AddRoleRequest $request, User $user)
    {
        $this->authorize('addRole', User::class);
        $user->assignRole($request->role);
        newFeedback();
        return back();
    }

    public function removeRole(User $user, Role $role)
    {
        $this->authorize('removeRole', User::class);
        $user->removeRole($role);
        return AjaxResponses::success();
    }

    public function manualVerify(User $user)
    {
        $this->authorize('manualVerify', User::class);
        $this->userRepository->manualVerify($user);
        return AjaxResponses::success();
    }

    public function updatePhoto(UpdateUserPhoto $request)
    {
        $media=MediaUploadService::upload($request->file('image'));
        if (auth()->user()->image) auth()->user()->image->delete();
        auth()->user()->image_id=$media->id;
        auth()->user()->save();
        newFeedback();
        return back();
    }
}
