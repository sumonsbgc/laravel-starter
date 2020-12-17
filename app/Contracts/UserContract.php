<?php

namespace App\Contracts;

interface UserContract
{
    public function listUsers(string $order = 'id', string $sort = 'desc', array $columns = ['*']);
    
    public function paginate(int $limit);

    public function findUserById(int $id);

    public function createUser(array $data);

    public function updateUser(array $data, $id);

    public function deleteUser(int $id);

    public function uploadProfilePicture(array $file);
}