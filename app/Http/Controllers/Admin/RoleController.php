<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
    protected Role $role;
    public function __construct(Role $role)
    {
        $this->role = $role;
    }

    public function index(){
        $this->setPageTitle('Role Management', '');
        $roles = $this->role->getRoles();
        return view('admin.roles.index', ['roles' => $roles]);
    }

    public function store(Request $request){
        $valid = Validator::make($request->all(), [
            'name' => ['required', 'unique:roles', 'max:48']
        ]);

        if($valid->fails()){
            return redirect()->back()->withErrors($valid)->withInput();
        }

        if($this->role->store($request)){
            return redirect()->back()->with(['status' => 'success', 'message' => 'Role has been created successfully']);
        }
    }

}
