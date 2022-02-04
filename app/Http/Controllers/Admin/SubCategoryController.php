<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\SubCategoryRepositoryInterface;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class SubCategoryController extends Controller
{

    private SubCategoryRepositoryInterface $subCategoryRepository;

    public function __construct(SubCategoryRepositoryInterface $subCategoryRepository)
    {
        $this->subCategoryRepository = $subCategoryRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->subCategoryRepository->getAllSubCategory();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = array();
        $data['categories'] =  $this->subCategoryRepository->getAllCategory();
        return view('admin.sub_category.create')->with($data);
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
            'name' => 'required|string|max:255|unique:sub_categories',
            'image' => 'required|mimes:png,jpg,jpeg',
            'category' => 'required'
       ]);

       $params = $request->except('_token');
       $category = $this->subCategoryRepository->createSubCategory($params);

        if (!$category) {
            return $this->responseRedirectBack('Error occurred while creating category.', 'error', true, true);
        }

        return redirect()->route('admin.sub-category.index')->with('success','Sub Category created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category_details = $this->subCategoryRepository->findSubCategoryById($id);
        return view('admin.sub_category.view',compact('category_details'));
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
        $data['category_list'] =  $this->subCategoryRepository->getAllCategory();
        $data['category_details'] = $this->subCategoryRepository->findSubCategoryById($id);
        return view('admin.sub_category.edit')->with($data);
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
            'name' => 'required|string|max:255',
            'image' => 'nullable|mimes:png,jpg,jpeg',
            'category' => 'required',
            'status' => 'required'
       ]);

       $category_details = $request->except('_token');

       $category = $this->subCategoryRepository->updateSubCategory($category_details);

       if (!$category) {
           return $this->responseRedirectBack('Error occurred while updating category.', 'error', true, true);
       }
        return redirect()->route('admin.sub-category.index')->with('success','Sub Category details updated');
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
