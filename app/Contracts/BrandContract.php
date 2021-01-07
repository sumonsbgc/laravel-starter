<?php

namespace App\Contracts;

interface BrandContract
{
    public function listBrands(string $order = 'id', string $sort = 'desc', array $columns = ['*']);
    
    public function paginate(int $limit);

    public function findBrandById(int $id);

    public function createBrand(array $data);

    public function updateBrand(array $data, $id);

    public function deleteBrand(int $id);
}