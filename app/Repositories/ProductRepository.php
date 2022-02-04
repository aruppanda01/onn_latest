<?php

namespace App\Repositories;

use App\Interfaces\ProductRepositoryInterface;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductSize;
use App\Models\SubCategory;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use InvalidArgumentException;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{
    /**
     * CategoryRepository constructor.
     * @param Category $model
     */
    public function __construct(Product $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }
    public function getAllSubCategory()
    {
        return SubCategory::where('status',1)->latest()->get();
    }
    public function getAllCategory()
    {
        return Category::where('status',1)->latest()->get();
    }
    public function getAllProductSizes()
    {
        return ProductSize::where('status',1)->latest()->get();
    }
    public function getAllProduct()
    {
        $data = array();
        $data['products'] = Product::latest()->get();
        return view('admin.product.index')->with($data);
    }

    /**
     * @param int $id
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function findProductById(int $id){
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
    public function createProduct(array $productDetails)
    {
        try{
            $collection = collect($productDetails);
            $image = $collection['image'];
            $imageName = imageUpload($image,'sub_category');

            $new_product = new Product();

            // Available Sizes
            $available_sizes = $collection['available_sizes'];
            if ($available_sizes) {
                $new_product->available_sizes = implode(',', $available_sizes);
            }

            // Product Code
            $product_count = Product::count();
            $num_padded = sprintf("%06d", ($product_count + 1));
            $new_product->product_code = 'ONN' . $num_padded;

            $new_product->name = $collection['name'];
            $new_product->image_path = $imageName;
            $new_product->slug = Str::slug($collection['name']);
            $new_product->category_id = $collection['category'];
            $new_product->sub_category_id = $collection['sub_category'];
            $new_product->description = $collection['description'];
            $new_product->price = $collection['price'];
            $new_product->status = 1;
            $new_product->save();

            return $new_product;
        }
        catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
    }
    /**
     * @param array $params
     * @return Category|mixed
     */
    public function updateProduct(array $productDetails)
    {
        try{
                $update_product_details = $this->findProductById($productDetails['id']);

                if (!empty($productDetails['image'])) {
                    $image = $productDetails['image'];
                    $imageName = imageUpload($image,'product');
                }else {
                    $imageName = $update_product_details['image_path'];
                }

                 // Available Sizes
                $available_sizes = $productDetails['available_sizes'];
                if ($available_sizes) {
                    $update_product_details->available_sizes = implode(',', $available_sizes);
                }
                $update_product_details->name = $productDetails['name'];
                $update_product_details->category_id = $productDetails['category'];
                $update_product_details->sub_category_id = $productDetails['sub_category'];
                $update_product_details->description = $productDetails['description'];
                $update_product_details->price = $productDetails['price'];
                $update_product_details->image_path = $imageName;
                $update_product_details->slug = Str::slug($productDetails['name']);
                $update_product_details->status = $productDetails['status'];
                $update_product_details->save();

            return $update_product_details;
        }
        catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
    }
}
