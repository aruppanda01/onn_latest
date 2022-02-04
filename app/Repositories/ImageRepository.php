<?php

namespace App\Repositories;

use App\Interfaces\ImageRepositoryInterface;
use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use App\Models\ProductSize;
use App\Models\SubCategory;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use InvalidArgumentException;

class ImageRepository extends BaseRepository implements ImageRepositoryInterface
{
    /**
     * CategoryRepository constructor.
     * @param Category $model
     */
    public function __construct(Image $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }
    public function getAllImages()
    {
        $data = array();
        $data['images'] = Image::latest()->get();
        return view('admin.image.index')->with($data);
    }

    /**
     * @param int $id
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function findImageById(int $id){
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
    public function createImageDetails(array $imageDetails)
    {
        try{
            $collection = collect($imageDetails);


            $new_image_details = new Image();

            $image = $collection['image'];
            $new_image_details->image_path = imageUpload($image,'images');

            // Other Details
            $new_image_details->image_capture_date = $collection['capture_date'];
            $new_image_details->lat = $collection['latitude'];
            $new_image_details->lon = $collection['longitude'];
            $new_image_details->location = $collection['location'];
            $new_image_details->status = 1;
            $new_image_details->save();

            return $new_image_details;
        }
        catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
    }
    /**
     * @param array $params
     * @return Category|mixed
     */
    public function updateImageDetails(array $imageDetails)
    {
        try{
                $update_image_details = $this->findImageById($imageDetails['id']);

                if (!empty($imageDetails['image'])) {
                    $image = $imageDetails['image'];
                    $imageName = imageUpload($image,'product');
                }else {
                    $imageName = $update_image_details['image_path'];
                }

                $update_image_details->image_path = $imageName;
                // Other Details
                $update_image_details->image_capture_date = $imageDetails['capture_date'];
                $update_image_details->lat = $imageDetails['latitude'];
                $update_image_details->lon = $imageDetails['longitude'];
                $update_image_details->location = $imageDetails['location'];
                $update_image_details->status = $imageDetails['status'];
                $update_image_details->save();

            return $update_image_details;
        }
        catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
    }
}
