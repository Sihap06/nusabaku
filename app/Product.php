<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['product_name','price','address', 'description', 'stock', 'avatar'];

    public function categories()
    {
        return $this->belongsToMany(Category::class);

    }

    public function hasAnyCategories($categories){
        return null!== $this->categories()->whereIn('name', $categories)->first();
    }

    public function hasAnyCategory($category){
        return null!== $this->categories()->where('name', $category)->first();
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }
}
