<?php

namespace Sabt\Category\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Sabt\Category\Database\Factories\CategoryFactory;
use Sabt\Course\Models\Course;

class Category extends Model
{
    use HasFactory;
    protected $table    = 'categories';
    protected $fillable = [
        'name',
        'slug',
        'parent_id',
    ];

    protected static function newFactory()
    {
        return CategoryFactory::new();
    }

    public function getParentAttribute()
    {
        return (is_null($this->parent_id)) ? 'ندارد' : $this->parentCategory->name;
    }

    public function parentCategory()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function subCategories()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function courses()
    {
        return $this->hasMany(Course::class);
    }

    public function path()
    {
        return route('categories.show',$this->id);
    }
}
