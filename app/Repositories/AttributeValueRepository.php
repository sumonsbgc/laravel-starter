<?php 
namespace App\Repositories;

use App\Contracts\AttributeValueContract;
use App\Models\AttributeValue;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use InvalidArgumentException;

class AttributeValueRepository extends BaseRepository implements AttributeValueContract{

    public function __construct(AttributeValue $attributeValue)
    {
        parent::__construct($attributeValue);
    }

    public function listAttributeValues(string $order = 'id', string $sort = 'desc', array $columns = ['*'])
    {
        return $this->all($columns, $order, $sort);
    }

    public function findAttributeValueById(int $id)
    {
        try{
            return $this->findOrFailById($id);
        }catch(ModelNotFoundException $e){
            throw new ModelNotFoundException($e->getMessage());
        }
    }

    public function createAttributeValue(array $data)
    {
        try{
            $collection = collect($data)->except('_token');
            return $this->create($collection->all());
        }catch(QueryException $q){
            throw new InvalidArgumentException($q->getMessage());
        }
    }

    public function updateAttributeValue(array $data, $id)
    {
        try{
            $collection = collect($data)->except(['_token', '_method']);
            return $this->update($collection->all(), $id);
        }catch(QueryException $q){
            throw new InvalidArgumentException($q->getMessage());
        }
    }

    public function deleteAttributeValue(int $id)
    {
        try{
            return $this->delete($id);
        }catch(ModelNotFoundException $e){
            throw new ModelNotFoundException($e->getMessage());            
        }
    }
}