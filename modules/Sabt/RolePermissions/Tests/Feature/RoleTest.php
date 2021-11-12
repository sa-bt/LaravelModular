<?php


namespace Sabt\RolePermissions\Tests\Feature;


use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Sabt\RolePermissions\Database\Seeders\RoleAndPermissionSeeder;
use Sabt\RolePermissions\Models\Permission;
use Sabt\RolePermissions\Models\Role;
use Sabt\User\Models\User;
use Tests\TestCase;

class RoleTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;

    public function test_permitted_user_can_see_roles()
    {
        $this->actionAsAdmin();
        $this->get(route('roles.index'))->assertOk();
        $this->actionAsSuperAdmin();
        $this->get(route('roles.index'))->assertOk();
    }

    public function test_normal_user_can_not_see_roles()
    {
        $this->actionAsUser();
        $this->get(route('roles.index'))->assertStatus(403);
    }

    public function test_permitted_user_can_store_roles()
    {
        $this->actionAsAdmin();
        $countRoles = Role::count();
        $this->post(route('roles.store'), [
            "name"        => "role1",
            "permissions" => [
                Permission::MANAGE_CATEGORIES_PERMISSION,
                Permission::MANAGE_COURSES_OWN_PERMISSION,
            ]
        ])->assertRedirect(route('roles.index'));
        $this->assertEquals($countRoles + 1, Role::count());

        $this->actionAsSuperAdmin();
        $this->post(route('roles.store'), [
            "name"        => "role2",
            "permissions" => [
                Permission::MANAGE_CATEGORIES_PERMISSION,
                Permission::MANAGE_COURSES_OWN_PERMISSION,
            ]
        ])->assertRedirect(route('roles.index'));
        $this->assertEquals($countRoles + 2, Role::count());
    }

    public function test_normal_user_can_not_store_roles()
    {
        $this->actionAsUser();
        $countRoles = Role::count();
        $this->post(route('roles.store'), [
            "name"        => "role1",
            "permissions" => [
                Permission::MANAGE_CATEGORIES_PERMISSION,
                Permission::MANAGE_COURSES_OWN_PERMISSION,
            ]
        ])->assertStatus(403);
        $this->assertEquals($countRoles, Role::count());
    }

    public function test_permitted_user_can_see_edit_page()
    {
        $this->actionAsAdmin();
        $role = $this->createRole();
        $this->get(route('roles.edit', $role->id))->assertOk();
        $this->actionAsSuperAdmin();
        $this->get(route('roles.edit', $role->id))->assertOk();
    }

    public function test_normal_user_can_not_see_edit_page()
    {
        $this->actionAsUser();
        $role = $this->createRole();
        $this->get(route('roles.edit', $role->id))->assertStatus(403);
    }

    public function test_permitted_user_can_update_roles()
    {
        $this->actionAsAdmin();
        $role = $this->createRole();
        $this->put(route('roles.update', $role->id), [
            "id"          => $role->id,
            "name"        => "roleUpdated",
            "permissions" => [
                Permission::MANAGE_COURSES_PERMISSION,
            ]
        ])->assertRedirect(route('roles.index'));
        $role->refresh();
        $this->assertEquals("roleUpdated", $role->name);
        $this->assertEquals(1, $role->permissions->count());

        $this->actionAsSuperAdmin();
        $role = $this->createRole();
        $this->put(route('roles.update', $role->id), [
            "id"          => $role->id,
            "name"        => "roleSuperAdminUpdated",
            "permissions" => [
                Permission::MANAGE_COURSES_PERMISSION,
            ]
        ])->assertRedirect(route('roles.index'));
        $role->refresh();
        $this->assertEquals("roleSuperAdminUpdated", $role->name);
        $this->assertEquals(1, $role->permissions->count());


    }

    public function test_normal_user_can_not_update_roles()
    {
        $this->actionAsUser();
        $role = $this->createRole();
        $this->put(route('roles.update', $role->id), [
            "id"          => $role->id,
            "name"        => "roleUpdated",
            "permissions" => [
                Permission::MANAGE_COURSES_PERMISSION,
            ]
        ])->assertStatus(403);
        $this->assertEquals($role->name, $role->refresh()->name);
    }

public function test_permitted_user_can_delete_roles()
    {
        $this->actionAsAdmin();
        $role = $this->createRole();
        $this->delete(route('roles.destroy', $role->id))->assertOk();
        $this->assertEquals(count(Role::$roles),Role::count());


        $this->actionAsSuperAdmin();
        $role = $this->createRole();
        $this->delete(route('roles.destroy', $role->id))->assertOk();
        $this->assertEquals(count(Role::$roles),Role::count());

    }

    public function test_normal_user_can_not_delete_roles()
    {
        $this->actionAsUser();
        $role = $this->createRole();
        $this->delete(route('roles.update', $role->id))->assertStatus(403);
        $this->assertEquals($role->name, $role->refresh()->name);
        $this->assertEquals(count(Role::$roles)+1,Role::count());

    }


    private function actionAsAdmin()
    {
        $this->createUser();
        auth()->user()->givePermissionTo(Permission::MANAGE_ROLES_PERMISSION);
    }

    private function actionAsUser()
    {
        $this->createUser();
    }

    private function actionAsSuperAdmin()
    {
        $this->createUser();
        auth()->user()->givePermissionTo(Permission::SUPER_ADMIN_PERMISSION);
    }

    private function createUser()
    {
        $this->seed(RoleAndPermissionSeeder::class);
        $user = User::factory()->create();
        $this->actingAs($user);
    }

    public function createRole()
    {
        return Role::create([
                                "name" => "role1",
                            ])->syncPermissions([
                                                    Permission::MANAGE_CATEGORIES_PERMISSION,
                                                    Permission::MANAGE_COURSES_OWN_PERMISSION,
                                                ]);
    }
}
