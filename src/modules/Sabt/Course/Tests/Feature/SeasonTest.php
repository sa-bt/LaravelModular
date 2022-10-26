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
        $this->actionAsTeacher();
        $course   = Course::factory()->create();
        $season   = Season::factory()->create([
                                                  "course_id" => $course->id
                                              ]);
        $response = $this->put(route('seasons.update', $season->id), [
            "title" => "update title"
        ]);

        $response->assertRedirect(route('courses.show', $course->id));
        $season->refresh();
        $this->assertEquals('update title', $season->title);
    }

    public function test_permitted_user_can_not_update_other_users_season()
    {
        $this->actionAsTeacher();
        $course = Course::factory()->create();
        $season = Season::factory()->create([
                                                "course_id" => $course->id
                                            ]);
        $this->actionAsTeacher();
        $this->put(route('seasons.update', $season->id), [
            "title" => "update title"
        ])->assertStatus(403);

        $season->refresh();
        $this->assertNotEquals('update title', $season->title);
    }

    public function test_normal_user_can_not_update_season()
    {
        $this->actionAsTeacher();
        $course = Course::factory()->create();
        $season = Season::factory()->create([
                                                "course_id" => $course->id
                                            ]);
        $this->actionAsUser();
        $this->put(route('seasons.update', $season->id), [
            "title" => "update title"
        ])->assertStatus(403);

        $season->refresh();
        $this->assertNotEquals('update title', $season->title);
    }


    public function test_permitted_user_can_delete_season()
    {
        $this->actionAsTeacher();
        $course = Course::factory()->create();
        $season = Season::factory()->create([
                                                "course_id" => $course->id
                                            ]);
        $this->delete(route('seasons.destroy', $season->id))->assertOk();
        $this->assertEquals(0, Season::count());
    }

    public function test_permitted_user_can_not_delete_other_users_season()
    {
        $this->actionAsTeacher();
        $course = Course::factory()->create();
        $season = Season::factory()->create([
                                                "course_id" => $course->id
                                            ]);
        $this->actionAsTeacher();
        $this->delete(route('seasons.destroy', $season->id))->assertStatus(403);
        $this->assertEquals(1, Season::count());
    }

    public function test_normal_user_can_not_delete_season()
    {
        $this->actionAsAdmin();
        $course = Course::factory()->create();
        $season = Season::factory()->create([
                                                "course_id" => $course->id
                                            ]);
        $this->actionAsUser();
        $this->delete(route('seasons.destroy', $season->id))->assertStatus(403);
        $this->assertEquals(1, Season::count());
    }

    public function test_permitted_user_can_change_confirmation_status_season()
    {
        $this->actionAsAdmin();
        $course = Course::factory()->create();
        $season = Season::factory()->create([
                                                "course_id" => $course->id
                                            ]);
        $season->refresh();
        $this->assertEquals(Season::CONFIRMATION_STATUS_PENDING,$season->confirmation_status);

        $this->put(route('seasons.accept', $season->id))->assertOk();
        $season->refresh();
        $this->assertEquals(Season::CONFIRMATION_STATUS_ACCEPTED,$season->confirmation_status);

        $this->put(route('seasons.reject', $season->id))->assertOk();
        $season->refresh();
        $this->assertEquals(Season::CONFIRMATION_STATUS_REJECTED,$season->confirmation_status);
    }
    public function test_normal_user_can_not_change_confirmation_status_season()
    {
        $this->actionAsAdmin();
        $course = Course::factory()->create();
        $season = Season::factory()->create([
                                                "course_id" => $course->id
                                            ]);
        $season->refresh();
        $this->actionAsUser();

        $this->put(route('seasons.accept', $season->id))->assertStatus(403);
        $season->refresh();
        $this->assertEquals(Season::CONFIRMATION_STATUS_PENDING,$season->confirmation_status);

        $this->put(route('seasons.reject', $season->id))->assertStatus(403);
        $season->refresh();
        $this->assertEquals(Season::CONFIRMATION_STATUS_PENDING,$season->confirmation_status);
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
