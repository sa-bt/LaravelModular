<?php


namespace Sabt\Category\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Sabt\Category\Http\Requests\CategoryRequest;
use Sabt\Category\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        //todo CategoryRepository
        $categories = Category::all();
        return view('Category::index', compact('categories'));
    }

    public function store(CategoryRequest $request)
    {
        Category::create([
                             "name"      => $request->input('name'),
                             "slug"      => $request->input('slug'),
                             "parent_id" => $request->input('parent_id'),
                         ]);
return back();
    }
}
