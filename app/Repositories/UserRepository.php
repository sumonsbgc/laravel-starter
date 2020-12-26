<?php

namespace App\Repositories;

use App\Models\User;
use App\Contracts\UserContract;
use App\Models\Role;
use App\Traits\FileHandlingTrait;
use Illuminate\Http\UploadedFile;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use InvalidArgumentException;

class UserRepository extends BaseRepository implements UserContract
{

    use FileHandlingTrait;

    public function __construct(User $user)
    {
        parent::__construct($user);
    }

    public function listUsers(string $order = 'id', string $sort = 'desc', array $columns = ['*'])
    {
        return $this->all($columns, $order, $sort);
    }

    public function findUserById(int $id)
    {
        try {
            return $this->findOrFailById($id);
        } catch (ModelNotFoundException $e) {
            throw new ModelNotFoundException($e);
        }
    }

    public function createUser(array $data)
    {
        try {
            
            $userCollection = collect($data)->except(['_token', 'password_confirmation']);
            $profile_pic = null;
            $password = bcrypt($data['password']);

            if ($userCollection->has('profile_pic') && ($data['profile_pic'] instanceof UploadedFile)) {
                $profile_pic = $this->uploadFile($data['profile_pic']);                
            }

            $mergeUserData = !empty($profile_pic) ? $userCollection->merge(compact('profile_pic', 'password')) : $userCollection->merge(compact('password'));

            $user = $this->create($mergeUserData->all());

            $role = (new Role())->findById($data['role']);
            $user->roles()->sync($role);
            return $user;

        } catch (QueryException $e) {
            throw new InvalidArgumentException($e->getMessage());
        }
    }

    public function updateUser(array $data, $id)
    {
        try {
            $userCollection = collect($data)->except('_token');

            $user = $this->findById($id);
            $user->update($userCollection->all());
            
            $role = (new Role())->findById($data['role']);

            return $user->roles()->sync($role);

        } catch (QueryException $e) {
            throw new InvalidArgumentException($e->getMessage());
        }
    }

    public function deleteUser(int $id)
    {
        try {
            $user = $this->findUserById($id);
            if (!empty($user->profile_pic)) {
                $this->deleteFile($user->profile_pic);
            }
            return $user->delete();
            
        } catch (QueryException $e) {
            throw new InvalidArgumentException($e->getMessage());
        }
    }

    public function uploadProfilePicture(array $data)
    {
        try {

            $fileName = null;

            if (!empty($data['profile_pic']) && ($data['profile_pic'] instanceof UploadedFile)) {

                $user = $this->findOrFailById($data['id']);

                $fileName = $this->uploadFile($data['profile_pic'], 'profile');

                if (!empty($user->profile_pic)) {
                    $this->deleteFile($user->profile_pic);
                }

                $user->update([
                    'profile_pic' => $fileName,
                ]);

            }
            
            return $fileName;
        } catch (QueryException $e) {
            throw new InvalidArgumentException($e->getMessage());
        }
    }
}