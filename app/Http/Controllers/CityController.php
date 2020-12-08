<?php

namespace App\Http\Controllers;

use App\Models\City;

class CityController extends Controller
{
    public function findCityByCountryId($countryId){
        return City::where('country_id', $countryId)->get();
    }
}