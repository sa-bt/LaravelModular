<?php

namespace Sabt\Course\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Sabt\Category\Models\Category;
use Sabt\Course\Models\Course;
use Sabt\RolePermissions\Database\Seeders\RoleAndPermissionSeeder;
use Sabt\RolePermissions\Models\Permission;
use Sabt\User\Models\User;
use Tests\TestCase;

class CourseTest extends TestCase
{
    use RefreshDatabase;

    public function test_permitted_user_can_see_courses_index()
    {
        $this->actionAsAdmin();
        $this->get(route('courses.index'))->assertOk();
        $this->actionAsSuperUser();
        $this->get(route('courses.index'))->assertOk();
    }

    public function test_normal_user_can_see_courses_index()
    {
        $this->actionAsUser();
        $this->get(route('courses.index'))->assertStatus(403);
    }

    public function test_permitted_user_can_see_create_course_page()
    {
        $this->actionAsAdmin();
        $this->get(route('courses.create'))->assertOk();

        $this->actionAsUser();
        auth()->user()->givePermissionTo(Permission::MANAGE_COURSES_OWN_PERMISSION);
        $this->get(route('courses.create'))->assertOk();
    }

    public function test_normal_user_can_not_see_create_course_page()
    {
        $this->actionAsUser();
        $this->get(route('courses.create'))->assertStatus(403);
    }

    public function test_permitted_user_can_store_course()
    {
        $this->actionAsUser();
        auth()->user()->givePermissionTo(Permission::MANAGE_COURSES_OWN_PERMISSION, Permission::TEACH_PERMISSION);
        $category = Category::factory()->create();
        Storage::fake('local');
        $response = $this->post(route('courses.store'), $this->createCourse());
        $response->assertRedirect(route('courses.index'));
        $this->assertEquals(Course::count(),1);
    }

    public function test_permitted_user_can_see_edit_course_page()
    {
        $this->actionAsAdmin();
        $course = Course::factory()->create();
        $this->get(route('courses.edit', $course->id))->assertOk();

        $this->actionAsUser();
        $course = Course::factory()->create();
        auth()->user()->givePermissionTo(Permission::MANAGE_COURSES_OWN_PERMISSION);
        $this->get(route('courses.edit', $course->id))->assertOk();
    }


    public function test_permitted_user_can_not_edit_other_users_courses()
    {
        $this->actionAsUser();
        $course = Course::factory()->create();

        $this->actionAsUser();
        auth()->user()->givePermissionTo(Permission::MANAGE_COURSES_OWN_PERMISSION);
        $this->get(route('courses.edit', $course->id))->assertStatus(403);
    }

    public function test_normal_user_can_not_see_edit_course_page()
    {
        $this->actionAsUser();
        $course = Course::factory()->create();

        $this->get(route('courses.edit', $course->id))->assertStatus(403);
    }


    private function actionAsAdmin()
    {
        $this->createUser();
        auth()->user()->givePermissionTo(Permission::MANAGE_COURSES_PERMISSION);
    }

    private function actionAsUser()
    {
        $this->createUser();
    }

    private function actionAsSuperUser()
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

    private function createCourse()
    {
        $category = Category::factory()->create();
        return [
            "title"               => "required",
            "slug"                => "required",
            "priority"            => 12,
            "price"               => 150000,
            "percent"             => 90,
            "teacher_id"          => auth()->id(),
            "type"                => Course::TYPE_CASH,
            "status"              => Course::STATUS_COMPLETED,
            "category_id"         => $category->id,
            "image"               => UploadedFile::fake()->image('bannerTest.jpg'),
        ];
    }
}
