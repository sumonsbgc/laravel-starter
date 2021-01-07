<?php

namespace App\Repositories;

use App\Models\Product;
use App\Traits\FileHandlingTrait;
use App\Contracts\ProductContract;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use InvalidArgumentException;

class ProductRepository extends BaseRepository implements ProductContract
{
    use FileHandlingTrait;

    public function __construct(Product $product)
    {
        parent::__construct($product);
    }

    public function listProducts(string $order = 'id', string $sort = 'desc', array $columns = ['*'])
    {
        return $this->all($columns, $order, $sort);
    }

    public function findByProductId($id)
    {
        try{
            return $this->findOrFailById($id);
        }catch(ModelNotFoundException $e){
            throw new ModelNotFoundException($e->getMessage());
        }
    }

    public function createProduct(array $data)
    {
        try{
            $collection = collect($data)->except('_token');

        }catch(QueryException $q){
            throw new InvalidArgumentException($q->getMessage());            
        }
    }

    public function updateProduct(array $data, $id)
    {
        try{
            $collection = collect($data)->except('_token');
        }catch(QueryException $q){
            throw new InvalidArgumentException($q->getMessage());            
        }
    }

    public function deleteProduct($id)
    {
        try{
            $product = $this->findOrFailById($id);
            
            
        } catch (QueryException $e) {
            throw new InvalidArgumentException($e->getMessage());
        }
    }
}