<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    public function user(){
        return $this->hasMany(User::class);
    }

    public function findCitiesByCountryId($CountryId){
        $cities = $this->query()->where('country_id', $CountryId)->get();        
        return $cities;
    }
}
