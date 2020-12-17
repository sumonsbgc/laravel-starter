<?php

namespace App\Http\Controllers\Admin;

use App\Models\City;
use App\Contracts\UserContract;
use App\Traits\FileHandlingTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProfilePictureUploadRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;

class UserController extends Controller
{
    use FileHandlingTrait;
    protected $userRepo;

    public function __construct(UserContract $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function index()
    {
        $users = $this->userRepo->paginate(2);
        $this->setPageTitle('All Users', 'User Management');
        return view('admin.users.index', compact('users'));
    }

    public function create(){
        $this->setPageTitle('New User', 'User Management');
        return view('admin.users.create');
    }

    public function store(UserCreateRequest $request)
    {
        $this->userRepo->createUser($request->all());
        return $this->redirectRoute('admin.users', ['status' => 'success', 'message' => 'User has been created Successfully']);
    }

    public function edit($id)
    {
        $user = $this->userRepo->findUserById($id);
        $cities = (new City())->findCitiesByCountryId(Auth::user()->country_id);

        $this->setPageTitle('Edit Users', 'User Management');
        return view('admin.users.edit', compact('user', 'cities'));
    }

    public function update(UserUpdateRequest $request, $id)
    {
        $this->userRepo->updateUser($request->all(), $id);
        return $this->redirectBack(['status' => 'success', 'message' => 'User Data has been updated successfully']);
    }

    public function upload_profile_pic(ProfilePictureUploadRequest $request)
    {        
        $fileName = $this->userRepo->uploadProfilePicture($request->all());

        return $this->responseJson([
            'status'   => 'success',
            'message'  => 'Profile picture has been updated successfully.',
            'fileName' => Storage::url($fileName)
        ]);
    }
}
