<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\ProductContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductPostRequest;
use App\Http\Requests\ProductPutRequest;

class ProductController extends Controller
{
    private $product;
    
    public function __construct(ProductContract $product)
    {
        $this->product = $product;        
    }

    public function index(){
        $products = $this->product->listProducts();
        return view('admin.products.index', compact('products'));
    }

    public function create(){
        return view('admin.products.create');
    }
    
    public function store(ProductPostRequest $request){
        $this->product->createProduct($request->all());

        return $this->redirectBack([
            'status' => 'success',
            'message' => 'Product record has been created successfully'
        ]);
    }
    
    public function edit($id){
        $product = $this->product->findByProductId($id);
        return view('admin.products.create', compact('product'));
    }
    
    public function update(ProductPutRequest $request, $id){
        $this->product->updateProduct($request->all(), $id);

        return $this->redirectBack([
            'status' => 'success',
            'message' => 'Product record has been updated successfully'
        ]);
    }

    public function delete($id){
        $this->product->deleteProduct($id);

        return $this->redirectRoute('admin.products', [
            'status' => 'success',
            'message' => 'Product record has been deleted successfully'
        ]);
    }

}
