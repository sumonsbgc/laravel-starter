<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    private $user;
    
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function index(){
        $this->setPageTitle('All Users', 'User Management');
        return view('admin.users.index', ['users' => $this->user->all()]);
    }

    public function store(Request $request){

    }

    public function edit($id){     
        $this->setPageTitle('Edit Users', 'User Management');           
        return view('admin.users.edit', ['user' => $this->user->findById($id)]);
    }

    public function update(Request $request, $id){

        $valid = Validator::make($request->all(), [
            'first_name' => ['required', 'max:70'],
            'last_name' => ['required', 'max:70'],
            'email' => ['required', 'max:70'],
            'user_name' => ['required', 'max:100'],
            'mobile' => ['required', 'max:15'],
            'birth_date' => [],
            'gender' => [],
            'country_id' => [],
            'city_id' => [],
            'address' => [],
        ]);
        
        if($valid->fails()){
            return redirect()->back()->withErrors($valid)->withInput();
        }


    }
}