<?php


namespace Sabt\Category\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Sabt\Category\Http\Requests\CategoryRequest;
use Sabt\Category\Models\Category;
use Sabt\Category\Repositories\CategoryRepository;
use Sabt\Common\Responses\AjaxResponses;

class CategoryController extends Controller
{
    public $repository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->repository = $categoryRepository;
    }

    public function index()
    {
        $this->authorize('manage',Category::class);
        $categories = $this->repository->all();
        return view('Category::index', compact('categories'));
    }

    public function store(CategoryRequest $request)
    {
        $this->authorize('manage',Category::class);
        $this->repository->create($request);
        return back();
    }

    public function edit(Category $category)
    {
        $this->authorize('manage',Category::class);
        $categories = $this->repository->allExceptById($category->id);
        return view('Category::edit', compact('categories', 'category'));

    }

    public function update(Category $category, CategoryRequest $request)
    {
        $this->authorize('manage',Category::class);
        $this->repository->edit($category, $request);
        return redirect()->route('categories.index');

    }

    public function destroy(Category $category)
    {
        $this->authorize('manage',Category::class);
        $this->repository->delete($category);
        return AjaxResponses::success();

    }
}
