<?php 
namespace App\Contracts;

interface CategoryContract{
    
    public function listCategories(string $order = 'id', string $sort = 'desc', array $columns = ['*']);
    
    public function paginate(int $limit);

    public function findCategoryById(int $id);

    public function createCategory(array $data);

    public function updateCategory(array $data, $id);

    public function deleteCategory(int $id);

}


?>