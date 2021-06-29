<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Admin\CategoryService;

class CategoryController extends BaseController
{
    public function __construct(CategoryService $cateService)
    {
        parent::__construct();
        $this->cateService = $cateService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = $this->cateService->getCategories();

        return view('admin.pages.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.category.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:categories,name',
            ],
            [
                'name.required' => 'Chưa nhập tên danh mục.',
                'name.unique' => 'Danh mục đã tồn tại'
            ]
        );

        $add = $this->cateService->create($request);

        if (!$add) {
            return back()->withInput()
                        ->withErrors(['failedMessage' => __('messages.add_category_failed')]);
        }

        return redirect()->route('admin.category.index')
                            ->with(['success' => __('messages.add_category_success')]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = $this->cateService->findById($id);
        return view('admin.pages.category.edit', compact('category'));
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
        $this->validate($request, [
            'name' => 'required',
            ],
            [
                'name.required' => 'Chưa nhập tên danh mục.',
            ]
        );

        $update = $this->cateService->update($request, $id);

        if (!$update) {
            return back()->withErrors(['failed'=>__('message.update_failed')]);
        }

        return redirect()->route('admin.category.index')
                            ->with(['success'=>__('messages.update_success')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = $this->cateService->delete($id);
    }
}
