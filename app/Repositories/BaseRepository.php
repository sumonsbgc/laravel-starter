<?php 

namespace App\Repositories;

use App\Contracts\BaseContract;
use Illuminate\Database\Eloquent\Model;

class BaseRepository implements BaseContract{

    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function all($columns = array('*'), string $orderBy = 'id', string $sortBy = 'desc')
    {
        return $this->model->orderBy($orderBy, $sortBy)->get($columns);
    }

    public function create(array $attributes)
    {
        return $this->model->create($attributes);
    }

    public function update(array $attributes, int $id)
    {
        return $this->findById($id)->update($attributes);
    }

    public function delete(int $id)
    {
        return $this->findById($id)->delete();
    }

    public function bulkDelete(array $ids)
    {
        return null;
    }

    public function findById(int $id)
    {
        return $this->model->find($id);
    }

    public function findOrFailById(int $id)
    {
        return $this->model->findOrFail($id);
    }

    public function findByColumns(array $data)
    {
        return $this->model->where($data)->first();
    }

    public function findOrFailByColumns(array $data)
    {
        return $this->model->where($data)->firstOrFail();
    }

    public function getByColumns(array $data)
    {
        return $this->model->where($data)->get();
    }
}

?>