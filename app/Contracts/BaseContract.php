<?php 

namespace App\Contracts;

interface BaseContract{
    public function create(array $attributes);

    public function update(array $attributes, int $id);

    public function all($columns = array('*'), string $orderBy = 'id', string $sortBy = 'desc');

    public function paginate(int $limit);

    public function findById(int $id);

    public function findOrFailById(int $id);
    
    public function findByColumns(array $data);

    public function firstOrFailByColumns(array $data);

    public function getByColumns(array $data);

    public function delete(int $id);
    
    public function bulkDelete(array $ids);
}

?>