<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    private $user;
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function index(){
        return view('admin.profile_edit');
    }

    public function edit($id){        
        return view('admin.profile_edit');
    }

    public function update(Request $request, $id){
        $valid = Validator::make($request->all(), [
            'first_name' => [],
            'last_name' => [],
            'email' => [],
            'user_name' => [],
            'mobile' => [],
            'country_id' => [],
            'city_id' => [],
            'address' => [],
        ]);
        
        if($valid->fails()){
            return redirect()->back()->withErrors($valid)->withInput();
        }

        

    }
}