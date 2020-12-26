<?php 
namespace App\Repositories;

use App\Contracts\AttributeContract;
use App\Models\Attribute;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use InvalidArgumentException;

class AttributeRepository extends BaseRepository implements AttributeContract{

    public function __construct(Attribute $attribute)
    {
        parent::__construct($attribute);
    }

    public function listAttributes(string $order = 'id', string $sort = 'desc', array $columns = ['*'])
    {
        return $this->all($columns, $order, $sort);
    }

    public function findAttributeById(int $id)
    {
        try{
            return $this->findOrFailById($id);
        }catch(ModelNotFoundException $e){
            throw new ModelNotFoundException($e->getMessage());
        }
    }

    public function createAttribute(array $data)
    {
        try{
            $collection = collect($data)->except('_token');
            $is_filterable = $collection->has('is_filterable') ? 1 : 0;
            $is_required = $collection->has('is_required') ? 1 : 0;

            $merge = $collection->merge(compact('is_filterable', 'is_required'));

            return $this->create($merge->all());

        }catch(QueryException $q){
            throw new InvalidArgumentException($q->getMessage());
        }
    }

    public function updateAttribute(array $data, $id)
    {
        try{
            
            $collection = collect($data)->except(['_token', '_method']);
            $is_filterable = $collection->has('is_filterable') ? 1 : 0;
            $is_required = $collection->has('is_required') ? 1 : 0;

            $merge = $collection->merge(compact('is_filterable', 'is_required'));

            return $this->update($merge->all(), $id);

        }catch(QueryException $q){
            throw new InvalidArgumentException($q->getMessage());
        }
    }

    public function deleteAttribute(int $id)
    {
        try{
            return $this->delete($id);
        }catch(ModelNotFoundException $e){
            throw new ModelNotFoundException($e->getMessage());            
        }
    }
}