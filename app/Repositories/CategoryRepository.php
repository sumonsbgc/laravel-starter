<?php 
namespace App\Repositories;

use App\Contracts\CategoryContract;
use App\Models\Category;
use App\Traits\FileHandlingTrait;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\UploadedFile;
use InvalidArgumentException;

class CategoryRepository extends BaseRepository implements CategoryContract{

    use FileHandlingTrait;

    public function __construct(Category $category)
    {
        parent::__construct($category);
    }

    public function listCategories(string $order = 'id', string $sort = 'desc', array $columns = ['*']){
        return $this->all($columns, $order, $sort);
    }
    
    public function findCategoryById(int $id){
        try{
            return $this->findOrFailById($id);
        }catch(ModelNotFoundException $e){
            throw new ModelNotFoundException($e->getMessage());
        }
    }

    public function createCategory(array $data){
        try{
            $collection = collect($data)->except('_token');
            $image      = null;

            if($collection->has('image') && ($data['image'] instanceof UploadedFile )){
                $image = $this->uploadFile($data['image'], 'categories');
            };

            $featured = $collection->has('featured') ? 1: null;
            $menu     = $collection->has('menu') ? 1 : null;
            $merge    = $collection->merge(compact('image', 'featured', 'menu'));

            return $this->create($merge->all());

        }catch(QueryException $q){
            throw new InvalidArgumentException($q->getMessage());            
        }
    }

    public function updateCategory(array $data, $id){
        try{            
            $collection = collect($data)->except('_token');
            $image      = null;
            $category   = $this->findCategoryById($id);

            if($collection->has('image') && ($data['image'] instanceof UploadedFile )){
                $image = $this->uploadFile($data['image'], 'categories');                
                if(!empty($image) && !empty($category->image)){
                    $this->deleteFile($category->image);
                }
                $collection = $collection->merge(compact('image'));
            }

            $featured = $collection->has('featured') ? 1: null;
            $menu     = $collection->has('menu') ? 1 : null;

            $merge    = $collection->merge(compact('featured', 'menu'));

            return $category->update($merge->all());

        }catch(QueryException $q){
            throw new InvalidArgumentException($q->getMessage());
        }
    }

    public function deleteCategory(int $id){
        try {
            
            $category = $this->findCategoryById($id);
            if (!empty($category->profile_pic)) {
                $this->deleteFile($category->profile_pic);
            }

            return $category->delete();
            
        } catch (QueryException $e) {
            throw new InvalidArgumentException($e->getMessage());
        }
    }
}