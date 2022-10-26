<?php

namespace Sabt\Course\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Sabt\Category\Models\Category;
use Sabt\Course\Models\Course;
use Sabt\Course\Models\Lesson;
use Sabt\Course\Models\Season;
use Sabt\RolePermissions\Database\Seeders\RoleAndPermissionSeeder;
use Sabt\RolePermissions\Models\Permission;
use Sabt\User\Models\User;
use Tests\TestCase;

class LessonTest extends TestCase
{
    use RefreshDatabase;


    public function test_permitted_user_can_see_create_lesson_form()
    {
        $this->actionAsTeacher();
        $course = $this->createCourse();
        $this->get(route('lessons.create', $course->id))->assertOk();

        $this->actionAsAdmin();
        $this->get(route('lessons.create', $course->id))->assertOk();

    }

    public function test_normal_user_can_not_see_create_lesson_form()
    {
        $this->actionAsTeacher();
        $course = $this->createCourse();
        $this->actionAsUser();
        $this->get(route('lessons.create', $course->id))->assertStatus(403);

    }

    public function test_permitted_user_can_create_lesson()
    {
        $this->actionAsTeacher();
        $course = $this->createCourse();
        $this->post(route('lessons.store', $course->id), [
            "title" => "lesson 1",
            "time" => "20",
            "free" => 1,
            "lessonFile" => UploadedFile::fake()->create('fileTest.mp4', 10024),
        ]);
        $this->assertEquals(1, Lesson::count());
        $this->actionAsAdmin();
        $this->post(route('lessons.store', $course->id), [
            "title" => "lesson 1",
            "time" => 20,
            "free" => 1,
            "lessonFile" => UploadedFile::fake()->create('fileTest.mp4', 10024),
        ]);
        $this->assertEquals(2, Lesson::count());
    }

    public function test_normal_user_can_not_create_lesson()
    {
        $this->actionAsAdmin();
        $course = Course::factory()->create();
        $this->actionAsUser();
        $this->post(route('lessons.store', $course->id), [
            "title" => "lesson 1",
            "time" => 20,
            "free" => 1,
            "lessonFile" => UploadedFile::fake()->create('fileTest.mp4', 10024),
        ])->assertStatus(403);

        $this->actionAsTeacher();
        $this->post(route('lessons.store', $course->id), [
            "title" => "lesson 1",
            "time" => 20,
            "free" => 1,
            "lessonFile" => UploadedFile::fake()->create('fileTest.mp4', 10024),
        ])->assertStatus(403);
    }

    public function test_only_allowed_extensions_can_be_uploaded()
    {
        $notAllowedExtensions = ['jpg', 'png', 'mp3'];
        $this->actionAsAdmin();
        $course = Course::factory()->create();
        foreach ($notAllowedExtensions as $extension) {
            $this->post(route('lessons.store', $course->id), [
                "title" => "lesson 1",
                "time" => 20,
                "free" => 1,
                "lessonFile" => UploadedFile::fake()->create('fileTest.' . $extension, 10024),
            ]);
        }

        $this->assertEquals(0, Lesson::count());
    }


    public function test_permitted_user_can_see_edit_lesson_form()
    {
        $this->actionAsAdmin();
        $course = Course::factory()->create();
        $lesson = Lesson::factory()->create([
            'course_id' => $course->id
        ]);
        $this->get(route('lessons.edit', [$course->id, $lesson->id]))->assertOk();

        $this->actionAsTeacher();
        $this->get(route('lessons.edit', [$course->id, $lesson->id]))->assertStatus(403);
    }


    public function test_permitted_user_can_not_see_edit_lesson_page_other_users()
    {
        $this->actionAsTeacher();
        $course = Course::factory()->create();
        $lesson = Lesson::factory()->create([
            'course_id' => $course->id
        ]);
        $this->get(route('lessons.edit', [$course->id, $lesson->id]))->assertOk();

        $this->actionAsTeacher();
        $this->get(route('lessons.edit', [$course->id, $lesson->id]))->assertStatus(403);
    }

    public function test_normal_user_can_not_see_edit_lesson_page()
    {
        $this->actionAsTeacher();
        $course = Course::factory()->create();
        $lesson = Lesson::factory()->create([
            'course_id' => $course->id
        ]);
        $this->get(route('lessons.edit', [$course->id, $lesson->id]))->assertOk();

        $this->actionAsUser();
        $this->get(route('lessons.edit', [$course->id, $lesson->id]))->assertStatus(403);
    }

    public function test_permitted_user_can_update_lesson()
    {
        $this->actionAsAdmin();
        $course = Course::factory()->create();
        $lesson = Lesson::factory()->create([
            'course_id' => $course->id
        ]);
        $response = $this->put(route('lessons.update', [$course->id, $lesson->id]), [
            "title" => "updated lesson",
            "free"=>1
        ]);

        $response->assertRedirect(route('courses.show', $course->id));
        $lesson->refresh();
        $this->assertEquals('updated lesson', $lesson->title);
    }

    public function test_permitted_user_can_not_update_other_users_lesson()
    {
        $this->actionAsAdmin();
        $course = Course::factory()->create();
        $lesson = Lesson::factory()->create([
            'title'=>'title',
            'course_id' => $course->id
        ]);
        $this->actionAsTeacher();
        $response = $this->put(route('lessons.update', [$course->id, $lesson->id]), [
            "title" => "updated lesson",
            "free"=>1
        ])->assertStatus(403);

        $lesson->refresh();
        $this->assertEquals('title', $lesson->title);
    }

    public function test_normal_user_can_not_update_lesson()
    {
        $this->actionAsAdmin();
        $course = Course::factory()->create();
        $lesson = Lesson::factory()->create([
            'title'=>'title',
            'course_id' => $course->id
        ]);
        $this->actionAsUser();
        $response = $this->put(route('lessons.update', [$course->id, $lesson->id]), [
            "title" => "updated lesson",
            "free"=>1
        ])->assertStatus(403);

        $lesson->refresh();
        $this->assertEquals('title', $lesson->title);
    }


    public function test_permitted_user_can_delete_lesson()
    {
        $this->actionAsAdmin();
        $course = Course::factory()->create();
        $lesson = Lesson::factory()->create([
            'title'=>'title',
            'course_id' => $course->id
        ]);
        $this->delete(route('lessons.destroy', [$course->id, $lesson->id]))->assertOk();

        $this->assertEquals(0, Lesson::count());
    }

    public function test_permitted_user_can_not_delete_other_users_lesson()
    {
        $this->actionAsAdmin();
        $course = Course::factory()->create();
        $lesson = Lesson::factory()->create([
            'title'=>'title',
            'course_id' => $course->id
        ]);
        $this->actionAsTeacher();
        $this->delete(route('lessons.destroy', [$course->id, $lesson->id]))->assertStatus(403);

        $this->assertEquals(1, Lesson::count());
    }

    public function test_normal_user_can_not_delete_lesson()
    {
        $this->actionAsAdmin();
        $course = Course::factory()->create();
        $lesson = Lesson::factory()->create([
            'title'=>'title',
            'course_id' => $course->id
        ]);
        $this->actionAsUser();
        $this->delete(route('lessons.destroy', [$course->id, $lesson->id]))->assertStatus(403);

        $this->assertEquals(1, Lesson::count());
    }

    public function test_permitted_user_can_delete_all_lesson()
    {
        $this->actionAsAdmin();
        $course = Course::factory()->create();
        $lesson1 = Lesson::factory()->create([
            'title'=>'title1',
            'course_id' => $course->id
        ]);
        $lesson2 = Lesson::factory()->create([
            'title'=>'title2',
            'course_id' => $course->id
        ]);

        $this->delete(route('lessons.deleteMultiple',$course->id),["ids"=>"$lesson1->id,$lesson2->id"]);

        $this->assertEquals($course->lessons()->count(), 0);
    }

    public function test_permitted_user_can_accept_lesson()
    {
        $this->actionAsAdmin();
        $course = Course::factory()->create();
        $lesson = Lesson::factory()->create([
            'title'=>'title',
            'course_id' => $course->id
        ]);
        $this->put(route('lessons.accept', [$course->id, $lesson->id]))->assertOk();

        $lesson->refresh();
        $this->assertEquals(Lesson::CONFIRMATION_STATUS_ACCEPTED, $lesson->confirmation_status);
    }

    public function test_permitted_user_can_accept_all_lessons()
    {
        $this->actionAsAdmin();
        $course = Course::factory()->create();
        $lesson1 = Lesson::factory()->create([
            'title'=>'title1',
            'course_id' => $course->id
        ]);
        $lesson2 = Lesson::factory()->create([
            'title'=>'title2',
            'course_id' => $course->id
        ]);

        $this->assertEquals($course->lessons()->where('confirmation_status',Lesson::CONFIRMATION_STATUS_PENDING)->count(), $course->lessons()->count());
        $this->put(route('lessons.acceptMultiple', $course->id),["ids"=>"$lesson1->id,$lesson2->id"]);

        $this->assertEquals($course->lessons()->where('confirmation_status',Lesson::CONFIRMATION_STATUS_ACCEPTED)->count(), $course->lessons()->count());
    }

    public function test_permitted_user_can_reject_lesson()
    {
        $this->actionAsAdmin();
        $course = Course::factory()->create();
        $lesson = Lesson::factory()->create([
            'title'=>'title',
            'course_id' => $course->id
        ]);
        $lesson->refresh();
        $this->assertEquals(Lesson::CONFIRMATION_STATUS_PENDING, $lesson->confirmation_status);
        $this->put(route('lessons.reject', [$course->id, $lesson->id]))->assertOk();

        $lesson->refresh();
        $this->assertEquals(Lesson::CONFIRMATION_STATUS_REJECTED, $lesson->confirmation_status);
    }


    public function test_permitted_user_can_reject_all_lessons()
    {
        $this->actionAsAdmin();
        $course = Course::factory()->create();
        $lesson1 = Lesson::factory()->create([
            'title'=>'title1',
            'course_id' => $course->id
        ]);
        $lesson2 = Lesson::factory()->create([
            'title'=>'title2',
            'course_id' => $course->id
        ]);

        $this->assertEquals($course->lessons()->where('confirmation_status',Lesson::CONFIRMATION_STATUS_PENDING)->count(), $course->lessons()->count());
        $this->put(route('lessons.rejectMultiple', $course->id),["ids"=>"$lesson1->id,$lesson2->id"]);

        $this->assertEquals($course->lessons()->where('confirmation_status',Lesson::CONFIRMATION_STATUS_REJECTED)->count(), $course->lessons()->count());
    }

    public function test_normal_user_can_not_change_confirmation_status_lesson()
    {
        $this->actionAsAdmin();
        $course = Course::factory()->create();
        $lesson1 = Lesson::factory()->create([
            'title'=>'title1',
            'course_id' => $course->id
        ]);
        $lesson2 = Lesson::factory()->create([
            'title'=>'title2',
            'course_id' => $course->id
        ]);
        $this->assertEquals($course->lessons()->where('confirmation_status',Lesson::CONFIRMATION_STATUS_PENDING)->count(), $course->lessons()->count());

        $this->actionAsUser();
        $this->put(route('lessons.rejectMultiple', $course->id),["ids"=>"$lesson1->id,$lesson2->id"]);

        $this->assertEquals($course->lessons()->where('confirmation_status',Lesson::CONFIRMATION_STATUS_PENDING)->count(), $course->lessons()->count());
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

    private function createUser()
    {
        $this->seed(RoleAndPermissionSeeder::class);
        $user = User::factory()->create();
        $this->actingAs($user);
    }

    private function createCourse()
    {
        return Course::factory()->create();
    }

    private function createSeason()
    {
        $course = Course::factory()->create();
        return $this->post(route('seasons.store', [
            "title" => "test",
            "course_id" => $course->id
        ]));
    }
}
