<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Traits\FileHandlingTrait;
use Illuminate\Http\Request;

class SettingController extends Controller
{

    use FileHandlingTrait;

    public function index(){
        $this->setPageTitle('Settings', 'Manage Settings');
        return view('admin.settings.index');
    }

    public function update(Request $request){
        $this->uploadFile($request->file('logo'));
    }
}
