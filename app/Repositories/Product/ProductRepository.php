<?php

namespace App\Repositories\Product;

use App\Models\Product;
use App\Repositories\RepositoryAbstract;

/**
 * Repository ProductRepository
 *
 * @package App\Repositories
 * @author HTT
 */
class ProductRepository extends RepositoryAbstract implements ProductRepositoryInterface
{
    /**
     * Get model name
     *
     * @return string
     */
    public function getModel()
    {
        return Product::class;
    }

    public function productWithCate()
    {
        return $this->model->with('category')->orderBy('id', 'desc');
    }

    /**
     * Get all product with properties and paginate
     * @param int $limit
     * @return Collection
     */
    public function getAllProductWithPaginate($limit)
    {
        return $this->model
            ->join('categories', 'categories.id', '=', 'products.category_id')
            ->leftJoin('specifications', 'specifications.product_id', '=', 'products.id')
            ->orderBy('categories.id')
            ->select('products.*', 'categories.id as cate_id', 'categories.name as cate_name', 'specifications.id as spec_id')
            ->paginate($limit);
    }

    /**
     * Get all product of category
     *
     * @return Collection
     */
    public function getAllProductOfCategory($id, $limit)
    {
        return $this->model->where('category_id', $id)->paginate($limit);
    }

    /**
     * Get product by id
     *
     * @return Collection
     */
    public function find($id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * Get related product except id $id
     * @param integer $id
     * @param integer $cate_id
     * @param integer $limit
     * @return Collection
     */
    public function getRelatedProduct($id, $cate_id, $limit)
    {
        return $this->model->whereNotIn('id', [$id])
                            ->where('category_id', $cate_id)
                            ->limit($limit)
                            ->get();
    }

    public function filter($request)
    {
        return $this->model->filter($request);
    }
}