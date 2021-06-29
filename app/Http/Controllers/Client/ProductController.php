<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Client\ProductService;
use App\Services\Client\CategoryService;
use App\Services\Client\SliderService;
use App\Services\Client\PictureService;

class ProductController extends BaseController
{
    public function __construct(
        ProductService $productService,
        CategoryService $categoryService,
        SliderService $sliderService,
        PictureService $pictureService
    ) {
        parent::__construct();
        $this->productService = $productService;
        $this->categoryService = $categoryService;
        $this->sliderService = $sliderService;
        $this->pictureService = $pictureService;
    }

    /**
     * Display the home page
     *
     * @return view
     */
    public function index() {
        // Get product, paginate $limit
        $products = $this->productService->getProduct($this->limit);
        return view('index', compact('products'));
    }

    /**
     * Get product of category
     *
     * @param  string  $slug
     * @return view
     */
    public function getProductOfCategory($slug)
    {
        // Get product of category, paginate $limit
        $products = $this->productService->getProductOfCategory($slug, $this->limit);

        return view('index', compact('products','slug'));
    }

    /**
     * Display product detail
     *
     * @param  int  $id
     * @return view
     */
    public function show($id)
    {
        $product = $this->productService->getProductById($id);
        $relatedProduct = $this->productService->getRelatedProduct($id, $product->category->id, $this->related_product_limit);
        $specification = $product->specification;
        $pictures = $product->picture;
        return view('client.products.product-detail', compact('product', 'relatedProduct', 'specification', 'pictures'));
    }

    /**
     * Product Filter
     *
     * @return Object
     */
    public function filter(Request $request)
    {
        $products = $this->productService->filter($request, $this->limit);
        if (!$products) {
            return View('index', compact('products'))
                    ->with(['NotFoundMessage'=>trans('messages.not_found', ['field'=>'sản phẩm'])]);
        }

        return View('index', compact('products'))
                ->with('successMess', trans('messages.find_success', ['total', $products->count()]));
    }
}
