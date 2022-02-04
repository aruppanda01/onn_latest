<?php

namespace App\Repositories;

use App\Interfaces\ProductSizeRepositoryInterface;
use App\Models\Category;
use App\Models\ProductSize;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use InvalidArgumentException;

class ProductSizeRepository extends BaseRepository implements ProductSizeRepositoryInterface
{
    /**
     * CategoryRepository constructor.
     * @param Category $model
     */
    public function __construct(ProductSize $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }
    public function getAllProductSizes()
    {
        $data = array();
        $data['available_sizes'] = ProductSize::latest()->get();
        return view('admin.product_size.index')->with($data);
    }

    /**
     * @param int $id
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function findProductSizeById(int $id){
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
    public function createProductSize(array $productSizeDetails)
    {
        try{
            $collection = collect($productSizeDetails);

            $new_size = new ProductSize();
            $new_size->size = $collection['size'];
            $new_size->status = 1;
            $new_size->save();

            return $new_size;
        }
        catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
    }
    /**
     * @param array $params
     * @return Category|mixed
     */
    public function updateProductSize(array $productSizeDetails)
    {
        try{
                $product_size_details = $this->findProductSizeById($productSizeDetails['id']);

                $product_size_details->size = $product_size_details->size;
                $product_size_details->status = $product_size_details->status;
                $product_size_details->save();

            return $product_size_details;
        }
        catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
    }
}
