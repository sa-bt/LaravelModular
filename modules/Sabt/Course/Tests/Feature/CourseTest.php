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
        $response = $this->createCourse();
        $response->assertRedirect(route('courses.index'));
        $this->assertEquals(Course::count(), 1);
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

    public function test_permitted_user_can_update_course()
    {
        $this->actionAsUser();
        auth()->user()->givePermissionTo(Permission::MANAGE_COURSES_OWN_PERMISSION, Permission::TEACH_PERMISSION);
        $course   = Course::factory()->create();
        $response = $this->put(route('courses.update', $course->id), [
            "title"       => "update title",
            "slug"        => "test",
            "priority"    => 12,
            "price"       => 150000,
            "percent"     => 90,
            "body"        => 90,
            "teacher_id"  => auth()->id(),
            "category_id" => $course->category->id,
            "type"        => Course::TYPE_CASH,
            "status"      => Course::STATUS_COMPLETED,
            "image"       => UploadedFile::fake()->image('bannerTest.jpg'),
        ]);
        $response->assertRedirect(route('courses.index'));
        $course->refresh();
        $this->assertEquals('update title', $course->title);
    }

    public function test_normal_user_can_not_update_course()
    {
        $this->actionAsAdmin();
        $course = Course::factory()->create();
        $title  = $course->title;

        $this->actionAsUser();
        auth()->user()->givePermissionTo(Permission::TEACH_PERMISSION);
        $response = $this->put(route('courses.update', $course->id), [
            "title"       => "update title",
            "slug"        => "test",
            "priority"    => 12,
            "price"       => 150000,
            "percent"     => 90,
            "body"        => 90,
            "teacher_id"  => auth()->id(),
            "category_id" => $course->category->id,
            "type"        => Course::TYPE_CASH,
            "status"      => Course::STATUS_COMPLETED,
            "image"       => UploadedFile::fake()->image('bannerTest.jpg'),
        ]);
        $response->assertStatus(403);
        $course->refresh();
        $this->assertEquals($title, $course->title);
    }

    public function test_permitted_user_can_delete_course()
    {
        $this->actionAsAdmin();
        $course = Course::factory()->create();
        $this->delete(route('courses.destroy', $course->id))->assertOk();
        $this->assertEquals(0, Course::count());
    }

    public function test_normal_user_can_not_delete_course()
    {
        $this->actionAsAdmin();
        $course = Course::factory()->create();

        $this->actionAsUser();
        $this->delete(route('courses.destroy', $course->id))->assertStatus(403);
        $this->assertEquals(1, Course::count());
    }

    public function test_permitted_user_can_change_confirmation_status_course()
    {
        $this->actionAsAdmin();
        $course = Course::factory()->create();
        $this->put(route('courses.accept', $course->id))->assertOk();
        $this->put(route('courses.reject', $course->id))->assertOk();
        $this->put(route('courses.lock', $course->id))->assertOk();
    }

    public function test_normal_user_can_not_change_confirmation_status_course()
    {

        $this->actionAsAdmin();
        $course = Course::factory()->create();

        $this->actionAsUser();
        $this->put(route('courses.accept', $course->id))->assertStatus(403);
        $this->put(route('courses.reject', $course->id))->assertStatus(403);
        $this->put(route('courses.lock', $course->id))->assertStatus(403);
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
        Storage::fake('local');
        $category = Category::factory()->create();
        $data     = [
            "title"       => "required",
            "slug"        => "required",
            "priority"    => 12,
            "price"       => 150000,
            "percent"     => 90,
            "teacher_id"  => auth()->id(),
            "type"        => Course::TYPE_CASH,
            "status"      => Course::STATUS_COMPLETED,
            "category_id" => $category->id,
            "image"       => UploadedFile::fake()->image('bannerTest.jpg'),
        ];
        return $this->post(route('courses.store'), $data);
    }
}
