<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Attribute extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'slug', 'frontend_type', 'is_filterable', 'is_required'
    ];

    public function values(){
        return $this->hasMany(AttributeValue::class);
    }

    public function setNameAttribute($value){
        $this->attributes['name'] = Str::ucfirst($value);
        $this->attributes['slug'] = Str::slug($value);
    }
}