<?php

namespace App\Services\Client;

use Illuminate\Http\Request;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\Product\ProductRepositoryInterface;

/**
 * Service ProductRepository
 *
 * @package App\Services\ProductRepository
 * @author HTT
 */
Class ProductService
{
    public function __construct(
        ProductRepositoryInterface $productRepo,
        CategoryRepositoryInterface $cateRepo
    ){
        $this->productRepo = $productRepo;
        $this->cateRepo = $cateRepo;
    }

    /**
     * Get product
     *
     * @param integer  $limit
     * @return Collection
     */
    public function getProduct($limit)
    {
        return $this->productRepo->getAllProductWithPaginate($limit);
    }

    /**
     * Get all data prodcut of category, paginate $limit
     *
     * @param integer  $limit
     * @return Collection
     */
    public function getProductOfCategory($slug, $limit)
    {
        $category = $this->cateRepo->getDataBySlug($slug);

        if (!$category) {
            return false;
        }

        return $this->productRepo->getAllProductOfCategory($category->id, $limit);
    }

    /**
     * Get product by id
     *
     * @param integer  $id
     * @return boolean
     */
    public function getProductById($id)
    {
        try {
            return $this->productRepo->find($id);
        } catch (Exception $e) {
            dd($e);
        }
    }

    /**
     * Get specification by product id
     *
     * @param integer  $id
     * @return collection
     */
    public function getSpecificationById($id)
    {
        return $this->productRepo->getSpecificationById($id);
    }

    /**
     * Get picture of product
     *
     * @param integer  $id
     * @return collection
     */
    public function getPictureOfProduct($id)
    {
        return $this->productRepo->getPictureOfProduct($id);
    }

    /**
     * Get related product except current id $id
     *
     * @param integer  $id
     * @param integer $cate_id
     * @param integer $limit
     * @return boolean
     */
    public function getRelatedProduct($id, $cate_id, $limit)
    {   
        $limit = $limit < 0 ? 4 : $limit;
        if ($cate_id < 0) {
            return false;
        }

        return $this->productRepo->getRelatedProduct($id, $cate_id, $limit);
    }

    /**
     * Filter product
     *
     * @param object  $request
     * @return boolean
     */
    public function filter($request, $limit)
    {
        // if not value filter then out
        if (count($request->all()) == 1) {
            return [];;
        }

        if (!strstr($request->fullUrl(), 'search')) {
            $queryString = parse_url(url()->previous(), PHP_URL_QUERY);
            parse_str($queryString, $query);
            $query['search'] = isset($query['search']) ? html_entity_decode($query['search']) : "";
            $request->merge(['search'=>$query['search']]);
        }   

        $products = $this->productRepo->filter($request);

        if ($products->count() == 0) {
            return [];
        }

        return $products->paginate($limit);
    }
}