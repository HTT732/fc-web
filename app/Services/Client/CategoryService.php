<?php

namespace App\Services\Client;

use Illuminate\Http\Request;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\Product\ProductRepositoryInterface;

/**
 * Service CategoryServics
 *
 * @package App\Services\CategoryService
 * @author HTT
 */
Class CategoryService
{
    public function __construct(
        CategoryRepositoryInterface $cateRepo,
        ProductRepositoryInterface $productRepo
    ){
        $this->cateRepo = $cateRepo;
        $this->productRepo = $productRepo;
    }

    /**
     * Get all categories
     *
     * @return Collection
     */
    public function getCategories()
    {
        return $this->cateRepo->getAllCategory();
    }

    public function filter($slug, $request, $limit)
    {
        if (count($request->all()) == 1) {
            return redirect()->back();
        }

        if (!strstr($request->fullUrl(), 'search')) {
            $queryString = parse_url(url()->previous(), PHP_URL_QUERY);
            parse_str($queryString, $query);
            $query['search'] = isset($query['search']) ? html_entity_decode($query['search']) : "";
            $request->merge(['search'=>$query['search']]);
        }  

        $request->merge(['slug' => $slug]);
        $products = $this->productRepo->filter($request);
        
        if (!$products) {
            return false;
        }
        return $products->paginate($limit);
    }
}