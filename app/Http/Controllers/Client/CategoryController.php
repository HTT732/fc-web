<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Client\CategoryService;
use App\Services\Client\ProductService;

class CategoryController extends BaseController
{
    public function __construct(
        CategoryService $cateService,
        ProductService $productService
    ) {
        parent::__construct();
        $this->cateService = $cateService;
        $this->productService = $productService;
    }

    public function filter($slug, Request $request)
    {
        $products = $this->cateService->filter($slug, $request, $this->limit);

        if (!$products) {
            return redirect()->back();
        }

        // return redirect()->route('category', ['slug'=>$slug, 'products'=>$products]);
        return View('index', compact('products', 'slug'));
    }
}
