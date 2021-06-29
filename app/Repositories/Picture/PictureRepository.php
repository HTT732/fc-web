<?php

namespace App\Repositories\Picture;

use App\Models\Picture;
use App\Repositories\RepositoryAbstract;
use App\Repositories\Picture\PictureRepositoryInterface;

/**
 * Repository PictureRepository
 *
 * @package App\Repositories
 * @author HTT
 */
class PictureRepository extends RepositoryAbstract implements PictureRepositoryInterface
{
    /**
     * Get model name
     *
     * @return string
     */
    public function getModel()
    {
        return Picture::class;
    }

    /**
     * Get picture of product
     * @param integer $id
     * @return string
     */
    public function getPictureByProductId($id)
    {
        return $this->model->where('product_id', $id)->get();
    }

    public function deleteByProductId($id)
    {
        return $this->model->where('product_id', $id)->delete();
    }
}