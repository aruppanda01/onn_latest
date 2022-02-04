<?php

namespace App\Repositories;

use App\Interfaces\SubCategoryRepositoryInterface;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use InvalidArgumentException;

class SubCategoryRepository extends BaseRepository implements SubCategoryRepositoryInterface
{
    /**
     * CategoryRepository constructor.
     * @param Category $model
     */
    public function __construct(SubCategory $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }
    public function getAllSubCategory()
    {
        $data = array();
        $data['categories'] = SubCategory::latest()->get();
        return view('admin.sub_category.index')->with($data);
    }
    public function getAllCategory()
    {
        return Category::where('status',1)->latest()->get();
    }

    /**
     * @param int $id
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function findSubCategoryById(int $id){
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
    public function createSubCategory(array $categoryDetails)
    {
        try{
            $collection = collect($categoryDetails);
            $image = $collection['image'];
            $imageName = imageUpload($image,'sub_category');

            $category = new SubCategory();
            $category->name = $collection['name'];
            $category->image_path = $imageName;
            $category->slug = Str::slug($collection['name']);
            $category->category_id = Str::slug($collection['category']);
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
    public function updateSubCategory(array $categoryDetails)
    {
        try{
                $category_details = $this->findSubCategoryById($categoryDetails['id']);

                if (!empty($categoryDetails['image'])) {
                    $image = $categoryDetails['image'];
                    $imageName = imageUpload($image,'category');
                }else {
                    $imageName = $category_details['image_path'];
                }
                $category_details->name = $category_details->name;
                $category_details->category_id = $category_details->category_id;
                $category_details->image_path = $imageName;
                $category_details->slug = Str::slug($category_details->name);
                $category_details->status = $category_details->status;
                $category_details->save();

            return $category_details;
        }
        catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
    }
}
