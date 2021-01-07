<?php 

namespace App\Repositories;

use App\Contracts\BrandContract;
use App\Models\Brand;
use App\Traits\FileHandlingTrait;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use InvalidArgumentException;

class BrandRepository extends BaseRepository implements BrandContract{

    use FileHandlingTrait;

    public function __construct(Brand $brand)
    {
        parent::__construct($brand);
    }

    public function listBrands(string $order = 'id', string $sort = 'desc', array $columns = ['*'])
    {
        return $this->all($columns, $order, $sort);
    }

    public function createBrand(array $data)
    {
        try {
            $collection = collect($data)->except('_token');

            $logo = $collection->has('logo') ? $this->uploadFile($data['logo'], 'brand') : null;
            $banner = $collection->has('banner') ? $this->uploadFile($data['banner'], 'brand') : null;

            $mergeCollection = $collection->merge(compact('logo', 'banner'));

            return $this->create($mergeCollection->all());
        } catch ( QueryException $q ) {
            throw new InvalidArgumentException($q->getMessage());
        }
    }

    public function findBrandById(int $id)
    {
        try{
            return $this->findOrFailById($id);
        } catch(ModelNotFoundException $m){
            throw new InvalidArgumentException($m->getMessage());
        }
    }

    public function updateBrand(array $data, $id)
    {
        try {
            $collection = collect($data)->except('_token');
            $brand = $this->findBrandById($id);

            if($collection->has('logo')){
                if(!empty($brand->logo)){
                    $this->deleteFile($brand->logo);
                }
                
                $logo = $this->uploadFile($data['logo'], 'brand');
                $collection = $collection->merge(compact('logo'));
            }

            if($collection->has('banner')){
                if(!empty($brand->banner)){
                    $this->deleteFile($brand->banner);
                }

                $banner = $this->uploadFile($data['banner'], 'brand');
                $collection = $collection->merge(compact('banner'));
            }

            return $this->update($collection->all(), $id);

        } catch (QueryException $q) {
            throw new InvalidArgumentException($q->getMessage());            
        }
    }

    public function deleteBrand(int $id)
    {
        try {
            $brand = $this->findBrandById($id);

            !empty($brand->banner) ? $this->deleteFile($brand->banner) : null;
            !empty($brand->logo) ? $this->deleteFile($brand->logo) : null;

            return $this->delete($id);

        } catch (ModelNotFoundException $m) {
            throw new ModelNotFoundException($m->getMessage());
        }
    }
}