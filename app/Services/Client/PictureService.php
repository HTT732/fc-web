<?php

namespace App\Services\Client;

use Illuminate\Http\Request;
use App\Repositories\Picture\PictureRepositoryInterface;

/**
 * Service PictureRepository
 *
 * @package App\Services\PictureRepository
 * @author HTT
 */
Class PictureService
{
    protected $pictureRepo;
    public function __construct(
        PictureRepositoryInterface $pictureRepo
    ){
        $this->pictureRepo = $pictureRepo;
    }

    /**
     * Get picture of product
     * @param integer $id
     * @return string
     */
    public function getPictureByProductId($id)
    {
        return $this->pictureRepo->getPictureByProductId($id);
    }

}