<?php

namespace App\Services\Admin;

use Illuminate\Http\Request;
use App\Repositories\Picture\PictureRepositoryInterface;
use App\Traits\ImageManipulation;

/**
 * Service PictureRepository
 *
 * @package App\Services\PictureRepository
 * @author HTT
 */
Class PictureService
{
    use ImageManipulation;

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

    public function deletePath($request)
    {
        if ($request->has('path')) {
            foreach ($data as $path) {
                foreach($path as $value) {
                    $this->deleteImageUpload($value);
                }
            }
        }
    }

    public function deletePicture($id)
    {
        $pictureId = [];
        if (!is_array($id)) {
            $pictureId[0] = $id;
        }
        $pictureId = $id;
        $pictures = $this->pictureRepo->findById($pictureId);
        
        if ($pictures) {
            foreach ($pictures as $path) {
                $this->deleteImageUpload($path->small);
                $this->deleteImageUpload($path->medium);
                $this->deleteImageUpload($path->large);
                $path->delete($path->id);
            }
        }

        return;
    }
}