<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Contracts\AttributeContract;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class AttributeController extends Controller
{
    private $attribute;

    public function __construct(AttributeContract $attr)
    {
        $this->attribute = $attr;
    }

    public function index(){
        $attributes = $this->attribute->paginate(10);

        $this->setPageTitle('Attribute Management', '');
        return view('admin.attribute.index', compact('attributes'));
    }

    public function create(){}

    public function store(Request $request){
        $valid = Validator::make($request->all(), [
            'name' => ['required', 'unique:attributes', 'max:30']
        ]);

        if($valid->fails()){
            return $this->redirectBackWithInput($valid->errors());
        }
        
        $this->attribute->createAttribute($request->all());
        return $this->redirectBack(['status' => 'success', 'message' => 'Attribute has been created successfully']);
    }

    public function edit($id){        
        $attr = $this->attribute->findAttributeById($id);

        return $this->responseJson([
            'status' => 'success',
            'attribute' => $attr
        ]);
    }

    public function update(Request $request, $id){

        $valid = Validator::make($request->all(), [
            'name' => ['required', 'max:30']
        ]);

        if($valid->fails()){
            return $this->redirectBackWithInput($valid->errors());
        }

        if($this->attribute->updateAttribute($request->all(), $id)){
            return $this->responseJson(['status' => 'success', 'message' => 'Attribute has been updated successfully']);
        }

        return $this->responseJson(['status' => 'error', 'message' => 'Sorry! There is some problem updating Attribute Data']);

    }
    
    public function delete($id){
        if($this->attribute->deleteAttribute($id)){
            return $this->responseJson(['status' => 'success', 'message' => 'Attribute has been deleted successfully']);
        }
        return $this->responseJson(['status' => 'error', 'message' => 'Sorry! There is some problem deleting Attribute Data']);
    }

}
