<?php

namespace App\Repositories;

use App\Interfaces\InvoiceRepositoryInterface;
use App\Models\Category;
use App\Models\Image;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\ProductSize;
use App\Models\SubCategory;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use InvalidArgumentException;

class InvoiceRepository extends BaseRepository implements InvoiceRepositoryInterface
{
    /**
     * CategoryRepository constructor.
     * @param Category $model
     */
    public function __construct(Invoice $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }
    public function getAllInvoices()
    {
        $data = array();
        $data['all_invoice_list'] = Invoice::latest()->get();
        return view('admin.invoice.index')->with($data);
    }

    /**
     * @param int $id
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function findInvoiceById(int $id){
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
    public function createInvoiceDetails(array $invoiceDetails)
    {
        try{
            $collection = collect($invoiceDetails);

            $new_invoice_details = new Invoice();

            $image = $collection['image'];
            $new_invoice_details->image_path = imageUpload($image,'images');

            // Other Details
            $new_invoice_details->invoice_date = $collection['invoice_date'];
            $new_invoice_details->lat = $collection['latitude'];
            $new_invoice_details->lon = $collection['longitude'];
            $new_invoice_details->location = $collection['location'];
            $new_invoice_details->amount = $collection['amount'];
            $new_invoice_details->is_verified = 1;
            $new_invoice_details->save();

            return $new_invoice_details;
        }
        catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
    }
    /**
     * @param array $params
     * @return Category|mixed
     */
    public function updateInvoiceDetails(array $invoiceDetails)
    {
        try{
                $update_invoice_details = $this->findInvoiceById($invoiceDetails['id']);

                if (!empty($invoiceDetails['image'])) {
                    $image = $invoiceDetails['image'];
                    $imageName = imageUpload($image,'product');
                }else {
                    $imageName = $update_invoice_details['image_path'];
                }

                $update_invoice_details->image_path = $imageName;

                // Other Details
                $update_invoice_details->invoice_date = $invoiceDetails['invoice_date'];
                $update_invoice_details->lat = $invoiceDetails['latitude'];
                $update_invoice_details->lon = $invoiceDetails['longitude'];
                $update_invoice_details->location = $invoiceDetails['location'];
                $update_invoice_details->amount = $invoiceDetails['amount'];
                $update_invoice_details->is_verified = $invoiceDetails['status'];
                $update_invoice_details->save();

            return $update_invoice_details;
        }
        catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
    }
}
