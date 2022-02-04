<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\ImageRepositoryInterface;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ImageController extends Controller
{
    private ImageRepositoryInterface $image_repository;

    public function __construct(ImageRepositoryInterface $image_repository)
    {
        $this->image_repository = $image_repository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->image_repository->getAllImages();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.image.create');
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
            'capture_date' => 'required|date',
            'latitude' => 'required|max:255',
            'longitude' => 'required|max:255',
            'location' => 'required|max:255',
        ]);

        $params = $request->except('_token');
        $product = $this->image_repository->createImageDetails($params);

        if (!$product) {
            return $this->responseRedirectBack('Error occurred while creating product.', 'error', true, true);
        }

        return redirect()->route('admin.image.index')->with('success','Image details added');

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
        $data['image_details'] = $this->image_repository->findImageById($id);
        return view('admin.image.view')->with($data);
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
        $data['image_details'] = $this->image_repository->findImageById($id);
        return view('admin.image.edit')->with($data);
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
            'capture_date' => 'required|date',
            'latitude' => 'required|max:255',
            'longitude' => 'required|max:255',
            'location' => 'required|max:255',
        ]);

        $image_details = $request->except('_token');

        $image_details = $this->image_repository->updateImageDetails($image_details);

        if (!$image_details) {
            return $this->responseRedirectBack('Error occurred while updating image.', 'error', true, true);
        }

        return redirect()->route('admin.image.index')->with('success','Image details updated');
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
