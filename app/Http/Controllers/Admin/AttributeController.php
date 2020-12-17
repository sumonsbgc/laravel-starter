<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;


class AttributeController extends Controller
{
    private $attribute;

    public function __construct()
    {
        $this->attribute = '';
    }

    public function index(){
        return view('admin.attribute.index');
    }

    public function create(){}

    public function store(){}

    public function edit(){}

    public function update(){}

    public function delete(){}

}
