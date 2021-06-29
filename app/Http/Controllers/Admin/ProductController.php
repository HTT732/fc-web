<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\BaseController;
use Illuminate\Http\Request;
use App\Services\Admin\ProductService;
use App\Services\Admin\PictureService;
use App\Http\Requests\ProductRequest;
use App\Services\Admin\CategoryService;

class ProductController extends BaseController
{
    public function __construct(
        ProductService $productService, 
        CategoryService $cateService,
        PictureService $pictureService
    )
    {
        parent::__construct();
        $this->productService = $productService;
        $this->cateService = $cateService;
        $this->pictureService = $pictureService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = $this->productService->all($this->limit);

        return view('admin.pages.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = $this->cateService->getCategoryActive();

        if(empty($categories)) {
            $categories = [];
        }

        return view('admin.pages.product.add', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $product = $this->productService->createProduct($request);

        if (!$product) {
            return back()->withInput()->with('failed', __('messages.add_product_failed'));
        }

        return back()->with('success', __('messages.add_product_success'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = $this->cateService->getCategoryActive();
        $product = $this->productService->getProductById($id);
        $picture = $this->pictureService->getPictureByProductId($id) ?? [];

        if (empty($categories) || empty($product)) {
            return view('admin.pages.error.404');
        }

        return view('admin.pages.product.edit', compact('categories', 'product', 'picture'));
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
        $update = $this->productService->updateProduct($request, $id);

        if (!$update) {
            return back()->withInput()->with('failed', __('messages.update_failed'));
        }

        return redirect()->route('admin.product.index')->with('successMessage', __('messages.update_success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $delete = $this->productService->delete($id);

        if ($request->ajax()) {
            return $delete;
        }

        return back()->with('successMessage', __('messages.delete_success'));
    }

    public function pictureUpload(Request $request)
    {
        return $this->productService->processPictureUpload($request);
    }

    public function pictureDelete(Request $request)
    {
        return $this->pictureService->deletePath($request);
    }
}
