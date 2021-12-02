<?php

namespace Sabt\Course\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Sabt\Category\Models\Category;
use Sabt\Course\Models\Course;
use Sabt\Course\Models\Season;
use Sabt\RolePermissions\Database\Seeders\RoleAndPermissionSeeder;
use Sabt\RolePermissions\Models\Permission;
use Sabt\User\Models\User;
use Tests\TestCase;

class SeasonTest extends TestCase
{
    use RefreshDatabase;


    public function test_permitted_user_can_create_season()
    {
        $this->actionAsAdmin();
        $this->createSeason();
        $this->assertEquals(1, Season::count());
        $this->actionAsTeacher();
        $this->createSeason();
        $this->assertEquals(2, Season::count());
        $this->assertEquals(1, Season::all()->last()->number);
    }

    public function test_normal_user_can_not_create_season()
    {
        $this->actionAsAdmin();
        $course = Course::factory()->create();
        $this->actionAsUser();
        $this->post(route('seasons.store', [
            "title"     => "test",
            "course_id" => $course->id
        ]))->assertStatus(403);

        auth()->user()->givePermissionTo(Permission::MANAGE_COURSES_OWN_PERMISSION);
        $this->post(route('seasons.store', [
            "title"     => "test",
            "course_id" => $course->id
        ]))->assertStatus(403);
    }

    public function test_permitted_user_can_see_edit_season_page()
    {
        $this->actionAsAdmin();
        $course = Course::factory()->create();
        $season = Season::factory()->create([
                                                "course_id" => $course->id
                                            ]);
        $this->get(route('seasons.edit', $season->id))->assertOk();

        $this->actionAsTeacher();
        $this->get(route('seasons.edit', $season->id))->assertStatus(403);
    }


    public function test_permitted_user_can_not_see_edit_season_page_other_users()
    {
        $this->actionAsTeacher();
        $course = Course::factory()->create();
        $season = Season::factory()->create([
                                                "course_id" => $course->id
                                            ]);

        $this->actionAsTeacher();
        $this->get(route('seasons.edit', $season->id))->assertStatus(403);

        $this->actionAsUser();
        auth()->user()->givePermissionTo(Permission::MANAGE_COURSES_OWN_PERMISSION);
        $this->get(route('seasons.edit', $season->id))->assertStatus(403);
    }

    public function test_normal_user_can_not_see_edit_season_page()
    {
        $this->actionAsTeacher();
        $course = Course::factory()->create();
        $season = Season::factory()->create([
                                                "course_id" => $course->id
                                            ]);

        $this->actionAsUser();
        $this->get(route('seasons.edit', $season->id))->assertStatus(403);
    }

    public function test_permitted_user_can_update_season()
    {
        $this->withoutExceptionHandling();
        $this->actionAsTeacher();
        $course = Course::factory()->create();
        $season = Season::factory()->create([
                                                "course_id" => $course->id
                                            ]);

        $response=$this->put(route('seasons.update', $season->id),[
            "title"=>"update title"
        ])->assertOk();

//        $response->assertRedirect(route('courses.show',$course->id));
        $season->refresh();
        $this->assertEquals('update title', $season->title);
    }

//    public function test_normal_user_can_not_update_course()
//    {
//        $this->actionAsAdmin();
//        $course = Course::factory()->create();
//        $title  = $course->title;
//
//        $this->actionAsUser();
//        auth()->user()->givePermissionTo(Permission::TEACH_PERMISSION);
//        $response = $this->put(route('courses.update', $course->id), [
//            "title"       => "update title",
//            "slug"        => "test",
//            "priority"    => 12,
//            "price"       => 150000,
//            "percent"     => 90,
//            "body"        => 90,
//            "teacher_id"  => auth()->id(),
//            "category_id" => $course->category->id,
//            "type"        => Course::TYPE_CASH,
//            "status"      => Course::STATUS_COMPLETED,
//            "image"       => UploadedFile::fake()->image('bannerTest.jpg'),
//        ]);
//        $response->assertStatus(403);
//        $course->refresh();
//        $this->assertEquals($title, $course->title);
//    }
//
//    public function test_permitted_user_can_delete_course()
//    {
//        $this->actionAsAdmin();
//        $course = Course::factory()->create();
//        $this->delete(route('courses.destroy', $course->id))->assertOk();
//        $this->assertEquals(0, Course::count());
//    }
//
//    public function test_normal_user_can_not_delete_course()
//    {
//        $this->actionAsAdmin();
//        $course = Course::factory()->create();
//
//        $this->actionAsUser();
//        $this->delete(route('courses.destroy', $course->id))->assertStatus(403);
//        $this->assertEquals(1, Course::count());
//    }
//
//    public function test_permitted_user_can_change_confirmation_status_course()
//    {
//        $this->actionAsAdmin();
//        $course = Course::factory()->create();
//        $this->put(route('courses.accept', $course->id))->assertOk();
//        $this->put(route('courses.reject', $course->id))->assertOk();
//        $this->put(route('courses.lock', $course->id))->assertOk();
//    }
//
//    public function test_normal_user_can_not_change_confirmation_status_course()
//    {
//
//        $this->actionAsAdmin();
//        $course = Course::factory()->create();
//
//        $this->actionAsUser();
//        $this->put(route('courses.accept', $course->id))->assertStatus(403);
//        $this->put(route('courses.reject', $course->id))->assertStatus(403);
//        $this->put(route('courses.lock', $course->id))->assertStatus(403);
//    }

    private function actionAsAdmin()
    {
        $this->createUser();
        auth()->user()->givePermissionTo(Permission::MANAGE_COURSES_PERMISSION);
    }

    private function actionAsUser()
    {
        $this->createUser();
    }

    private function actionAsTeacher()
    {
        $this->createUser();
        auth()->user()->givePermissionTo(Permission::MANAGE_COURSES_OWN_PERMISSION);
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

    private function createSeason()
    {
        $course = Course::factory()->create();
        return $this->post(route('seasons.store', [
            "title"     => "test",
            "course_id" => $course->id
        ]));
    }
}
