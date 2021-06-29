<?php
namespace App\Repositories\Category;

use App\Repositories\RepositoryInterface;

/**
 * Interface CategoryRepositoryInterface
 *
 * @package App\Repositories
 */
interface CategoryRepositoryInterface extends RepositoryInterface
{
   
    /**
     * Get categories
     *
     * @return mixed
     */
    public function getAllCategory();

    /**
     * Get categories by slug
     *
     * @return mixed
     */
    public function getDataBySlug($slug);
}
