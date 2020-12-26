<?php 

namespace App\Contracts;

interface AttributeContract{
    public function listAttributes(string $order = 'id', string $sort = 'desc', array $columns = ['*']);
    
    public function paginate(int $limit);

    public function findAttributeById(int $id);

    public function createAttribute(array $data);

    public function updateAttribute(array $data, $id);

    public function deleteAttribute(int $id);
}

?>