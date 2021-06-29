<?php
namespace App\Repositories\Product;

use App\Repositories\RepositoryInterface;

/**
 * Interface ProductRepositoryInterface
 *
 * @package App\Repositories
 */
interface ProductRepositoryInterface extends RepositoryInterface
{
    /**
     * Get all product with properties and paginate
     * @param int $limit
     * @return mixed
     */
    public function getAllProductWithPaginate($limit);

    /**
     * Get all product of category
     *
     * @return mixed
     */
    public function getAllProductOfCategory($id, $limit);

}
