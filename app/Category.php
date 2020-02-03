<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name', 'slug', 'updated_by', 'deleted_by', 'created_by'
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

}
