<?php 

namespace App\Contracts;

interface AttributeValueContract{
    public function listAttributeValues(string $order = 'id', string $sort = 'desc', array $columns = ['*']);

    public function paginate(int $limit);

    public function findAttributeValueById(int $id);

    public function createAttributeValue(array $data);

    public function updateAttributeValue(array $data, $id);

    public function deleteAttributeValue(int $id);
}

?>