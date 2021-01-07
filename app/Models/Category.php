<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'slug', 'description', 'parent_id', 'featured', 'menu', 'image'
    ];

    protected $cast = [
        'parent_id' => 'integer',
        'featured'  => 'boolean',
        'menu'      => 'boolean'
    ];

    public function setNameAttribute($value){
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }
    
    public function children(){ // sub_category
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function parent(){ // category
        return $this->belongsTo(Category::class, 'parent_id');
    }
}
