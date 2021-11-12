<?php

namespace Sabt\Category\Repositories;


use Sabt\Category\Models\Category;
use Sabt\Common\Responses\AjaxResponses;

class CategoryRepository
{

    public function all()
    {
        return Category::all();
    }

    public function create($values)
    {
        return Category::create([
                                    "name"      => $values->name,
                                    "slug"      => $values->slug,
                                    "parent_id" => $values->parent_id,
                                ]);
    }

    public function allExceptById($id)
    {
        return Category::all()->filter(function ($item) use ($id)
        {
            return $item->id != $id;
        });
    }

    public function edit($category, $values)
    {
        return $category->update([
                                     "name"      => $values->name,
                                     "slug"      => $values->slug,
                                     "parent_id" => $values->parent_id,
                                 ]);
    }

    public function delete($category)
    {
        return $category->delete();
    }
}
