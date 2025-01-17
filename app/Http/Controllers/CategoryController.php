<?php

namespace App\Http\Controllers;

use App\Contracts\CategoryContract;
use App\Http\Requests\CategoryPostRequest;

class CategoryController extends Controller
{
    private $cateogry;

    public function __construct(CategoryContract $cateogry)
    {
        $this->cateogry = $cateogry;
    }

    public function index(){
        $this->setPageTitle('Category Management', '');
        return view('admin.category.index');
    }

    public function store(CategoryPostRequest $request){
        $this->cateogry->createCategory($request->all());
        return $this->redirectBack([
            'status' => 'success',
            'message' => 'Category has been created successfully'
        ]);
    }

    public function edit($id){
        $category = $this->cateogry->findCategoryById($id);

        $this->setPageTitle('Edit Category', '');
        return view('admin.category.edit', compact('category'));
    }

    public function update(CategoryPostRequest $request, $id){
        $this->cateogry->updateCategory($request->all(), $id);
        return $this->redirectRoute('admin.categories', [
            'status' => 'success',
            'message' => 'Category has been created successfully'
        ]);
    }

    public function delete($id){
        $this->cateogry->deleteCategory($id);
        
        return $this->redirectRoute('admin.categories', [
            'status' => 'success',
            'message' => 'Category has been deleted successfully'
        ]);
    }
}