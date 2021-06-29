<?php

namespace App\Services\Admin;

use Illuminate\Http\Request;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Repositories\Picture\PictureRepositoryInterface;
use App\Services\Admin\PictureService;
use App\Traits\ImageManipulation;
/**
 * Service ProductRepository
 *
 * @package App\Services\ProductRepository
 * @author HTT
 */
Class ProductService
{
    use ImageManipulation;
    public function __construct(
        ProductRepositoryInterface $productRepo,
        CategoryRepositoryInterface $cateRepo,
        PictureRepositoryInterface $picRepo,
        PictureService $pictureService
    ){
        $this->productRepo = $productRepo;
        $this->cateRepo = $cateRepo;
        $this->picRepo = $picRepo;
        $this->pictureService = $pictureService;
    }

    public function all($limit)
    {
        $products = $this->productRepo->productWithCate();

        if (!$products) {
            return [];
        }
        
        return $products->get();
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
            // dd($e);
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

    public function delete($id)
    {
        $this->picRepo->deleteByProductId($id);
        
        return $this->productRepo->delete($id);
    }

    public function processPictureUpload($request)
    {
        if (!$request->has('file')) {
            return false;
        }

         // get info image
         $rootFolder = config('constants.upload.product.root');
         $listSize = config('constants.upload.product.size');
 
         if (!$rootFolder || !$listSize) {
             return false;
         }
 
         $result = $this->processUploadImage($request->file, $rootFolder, $listSize);
             
         if ($result['msgCode'] === 400) {
             return false;
         }

         return $result['image'];
    }

    public function createProduct($request)
    {
        $picture = [];
        $small = [];
        $medium = [];
        $large = [];

        if ($request->has('small') && $request->has('medium') && $request->has('large')) {
            $small = $request->small;
            $medium = $request->medium;
            $large = $request->large;
        }

        $input = $request->only(['name', 'description', 'short_description', 'price', 'category_id']);
        if (!empty($small[0])) {
            $input['thumb_url'] = $small[0];
        }

        if ($request->has('category_id')) {
            $slug = $this->cateRepo->findById($request->category_id);
        }
        $input['slug'] = $slug->slug;

        // Create product
        $result = $this->productRepo->create($input);
        
        if (!$result) {
            return false;
        }

        // Add images
        for ($i = 0; $i < count($small); $i ++) {
            $temp = [
                'name' => 'product_'.$i,
                'small' => $small[$i],
                'medium' => $medium[$i],
                'large' => $large[$i],
                'product_id' => $result->id
            ];
            array_push($picture, $temp);
        }

        
        $addImg = $this->picRepo->createMany($picture);
        if(!$addImg) {
            $this->productRepo->delete($result->id);
            return false;
        }

        return true;
    }

    public function updateProduct($request, $id) 
    {
        $picture = [];
        $small = [];
        $medium = [];
        $large = [];

        if ($request->has('picture_id')) {
            $this->pictureService->deletePicture($request->picture_id);
        }

        if ($request->has('small') && $request->has('medium') && $request->has('large')) {
            $small = $request->small;
            $medium = $request->medium;
            $large = $request->large;
        }
        
        $input = $request->only(['name', 'description', 'short_description', 'price', 'active','category_id']);
        if (!empty($small[0])) {
            $input['thumb_url'] = $small[0];
        }

        if ($request->has('category_id')) {
            $slug = $this->cateRepo->findById($request->category_id);
        }
        $input['slug'] = $slug->slug;

        // Create product
        $result = $this->productRepo->update($input, $id);
        
        if (!$result) {
            return false;
        }

        // Add images
        for ($i = 0; $i < count($small); $i ++) {
            $temp = [
                'name' => 'product_'.$i,
                'small' => $small[$i],
                'medium' => $medium[$i],
                'large' => $large[$i],
                'product_id' => $id
            ];
            array_push($picture, $temp);
        }

        
        $addImg = $this->picRepo->createMany($picture);
        if(!$addImg) {
            $this->productRepo->delete($result->id);
            return false;
        }

        return true;
    }
}