<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\InvoiceRepositoryInterface;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class InvoiceManagentController extends Controller
{
    private InvoiceRepositoryInterface $invoice_repository;

    public function __construct(InvoiceRepositoryInterface $invoice_repository)
    {
        $this->invoice_repository = $invoice_repository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->invoice_repository->getAllInvoices();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.invoice.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'image' => 'required|mimes:png,jpg,jpeg',
            'invoice_date' => 'required|date',
            'latitude' => 'required|max:255',
            'longitude' => 'required|max:255',
            'location' => 'required|max:255',
            'amount' => 'required'
        ]);

        $params = $request->except('_token');
        $invoice = $this->invoice_repository->createInvoiceDetails($params);

        if (!$invoice) {
            return $this->responseRedirectBack('Error occurred while creating invoice.', 'error', true, true);
        }

        return redirect()->route('admin.invoice.index')->with('success','Invoice details added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = array();
        $data['invoice_details'] = $this->invoice_repository->findInvoiceById($id);
        return view('admin.invoice.view')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = array();
        $data['invoice_details'] = Invoice::find($id);
        return view('admin.invoice.edit')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'image' => 'nullable|mimes:png,jpg,jpeg',
            'invoice_date' => 'required|date',
            'latitude' => 'required|max:255',
            'longitude' => 'required|max:255',
            'location' => 'required|max:255',
            'amount' => 'required'
        ]);

        $invoice_details = $request->except('_token');

        $invoice_details = $this->invoice_repository->updateInvoiceDetails($invoice_details);

        if (!$invoice_details) {
            return $this->responseRedirectBack('Error occurred while updating image.', 'error', true, true);
        }

        return redirect()->route('admin.invoice.index')->with('success','Invoice details updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
