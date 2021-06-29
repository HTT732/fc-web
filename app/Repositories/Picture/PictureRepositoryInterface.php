<?php
namespace App\Repositories\Picture;

use App\Repositories\RepositoryInterface;

/**
 * Interface PictureRepositoryInterface
 *
 * @package App\Repositories
 */
interface PictureRepositoryInterface extends RepositoryInterface
{
    /**
     * Get picture of product
     * @param integer $id
     * @return string
     */
    public function getPictureByProductId($id);
}
