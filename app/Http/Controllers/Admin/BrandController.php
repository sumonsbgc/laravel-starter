<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\BrandContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\BrandPostRequest;
use App\Http\Requests\BrandUpdateRequest;

class BrandController extends Controller
{
    private $brand;
    public function __construct( BrandContract $brand )
    {
        $this->brand = $brand;        
    }

    public function index(){
        $this->setPageTitle('Brand Management', '');

        $brands = $this->brand->paginate(2);
        return view('admin.brands.index', compact('brands'));
    }

    public function store(BrandPostRequest $request){
        $this->brand->createBrand($request->all());
        return $this->redirectBack(['status' => 'success', 'message' => 'Brand record has been created successfully.']);
    }

    public function edit($id){
        $brand = $this->brand->findBrandById($id);
        return $this->responseJson(['status' => 'success', 'brand' => $brand]);
    }

    public function update(BrandUpdateRequest $request, $id){
        $this->brand->updateBrand($request->all(), $id);
        return $this->redirectBack(['status' => 'success', 'message' => 'Brand record has been updated successfully.']);
    }

    public function delete($id){
        $this->brand->deleteBrand($id);
        return $this->redirectBack(['status' => 'success', 'message' => 'Brand record has been deleted successfully.']);
    }
}
