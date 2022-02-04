<?php

namespace App\Repositories;

use App\Interfaces\CategoryRepositoryInterface;
use App\Models\Category;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use InvalidArgumentException;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{
    /**
     * CategoryRepository constructor.
     * @param Category $model
     */
    public function __construct(Category $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }
    public function getAllCategory()
    {
        $data = array();
        $data['categories'] = Category::latest()->get();
        return view('admin.category.index')->with($data);
    }

    /**
     * @param int $id
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function findCategoryById(int $id){
        try {
            return $this->findOneOrFail($id);

        } catch (ModelNotFoundException $e) {

            throw new ModelNotFoundException($e);
        }
    }

    /**
     * @param array $params
     * @return Category|mixed
     */
    public function createCategory(array $categoryDetails)
    {
        try{
            $collection = collect($categoryDetails);
            $image = $collection['image'];
            $imageName = imageUpload($image,'category');

            $category = new Category();
            $category->name = $collection['name'];
            $category->image_path = $imageName;
            $category->slug = Str::slug($collection['name']);
            $category->status = 1;
            $category->save();

            return $category;
        }
        catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
    }
    /**
     * @param array $params
     * @return Category|mixed
     */
    public function updateCategory(array $categoryDetails)
    {
        try{
                $category_details = $this->findCategoryById($categoryDetails['id']);

                if (!empty($categoryDetails['image'])) {
                    $image = $categoryDetails['image'];
                    $imageName = imageUpload($image,'category');
                }else {
                    $imageName = $category_details['image_path'];
                }
                $category_details->name = $categoryDetails['name'];
                $category_details->image_path = $imageName;
                $category_details->slug = Str::slug($categoryDetails['name']);
                $category_details->status = $categoryDetails['status'];
                $category_details->save();

            return $category_details;
        }
        catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
    }
}
