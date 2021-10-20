<?php


namespace Sabt\Category\Tests\Feature;


use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Sabt\Category\Models\Category;
use Sabt\User\Models\User;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function test_authenticated_can_see_categories_panel()
    {
        $this->actionAsAdmin();
        $this->get(route('categories.index'))->assertOk();
    }

    public function test_admin_can_create_category()
    {
        $this->createCategory();
        $this->assertEquals(1, Category::count());
    }

    public function test_admin_can_update_category()
    {
        $newTitle = "categoryTest";
        $this->createCategory();
        $this->assertEquals(1, Category::count());
        $this->put(route('categories.update', 1), [
            "name" => $newTitle,
            "slug" => $newTitle,
        ]);
        $this->assertEquals(1, Category::query()->where('name', '=', $newTitle)->count());

    }

    public function test_admin_can_delete_category()
    {
        $this->createCategory();
        $this->delete(route('categories.destroy', 1), [
            "name" => $this->faker->word,
            "slug" => $this->faker->word,
        ])->assertOk();
        $this->assertEquals(0, Category::count());

    }

    private function actionAsAdmin()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
    }

    private function createCategory()
    {
        $this->actionAsAdmin();
        $this->post(route('categories.store'), [
            "name" => $this->faker->word,
            "slug" => $this->faker->word,
        ]);
    }
}
