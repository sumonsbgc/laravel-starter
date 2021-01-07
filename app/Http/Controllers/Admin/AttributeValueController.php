<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Contracts\AttributeValueContract;
use Illuminate\Support\Facades\Validator;

class AttributeValueController extends Controller
{
    private $attributeValue;

    public function __construct(AttributeValueContract $attributeValue)
    {
        $this->attributeValue = $attributeValue;
    }

    public function store(Request $request){
        $valid = Validator::make($request->all(), [
            'value' => ['required', 'string', 'max:50'],
        ]);
        
        if($valid->fails()){
            return response()->json($valid->errors());
        }

        $this->attributeValue->createAttributeValue($request->all());
        return $this->responseJson(['status' => 'success', 'message' => 'Attribute Value has been created successfully']);
    }

    public function edit($id){
        $value = $this->attributeValue->findAttributeValueById($id);
        return $this->responseJson(['status' => 'success', 'data' => $value]);
    }

    public function update(Request $request, $id){

        $valid = Validator::make($request->all(), [
            'value' => ['required', 'string', 'max:50'],
        ]);

        if($valid->fails()){
            return response()->json($valid->errors());
        }

        $this->attributeValue->updateAttributeValue($request->all(), $id);
        return $this->responseJson(['status' => 'success', 'message' => 'Attribute Value has been updated successfully']);
    }

    public function delete($id){
        $this->attribute->deleteAttribute($id);
        return $this->responseJson(['status' => 'success', 'message' => 'Attribute has been deleted successfully']);
    }
}