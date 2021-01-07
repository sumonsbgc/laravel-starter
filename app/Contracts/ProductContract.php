<?php 

namespace App\Contracts;

interface ProductContract {

    public function listProducts(string $order = 'id', string $sort = 'desc', array $columns = ['*']);
    public function paginate(int $limit);
    public function createProduct(array $data);
    public function findByProductId($id);
    public function updateProduct(array $data, $id);
    public function deleteProduct($id);

}