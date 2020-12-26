<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\AttributeValue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AttributeValueController extends Controller
{
    public function store(Request $request){
        Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:50'],
        ]);
        $attribute = Attribute::findOrFail($request->attribute_id);
        $attr_value = new AttributeValue();
        $attr_value->value = $request->get('value');
        $attr_value->attribute_id = $request->get('attribute_id');
        $attr_value->save();
        $attr_value->attribute()->associate($attribute);
        
        return $this->responseJson(['status' => 'success', 'message' => 'Attribute Value has been created successfully']);
    }
}
