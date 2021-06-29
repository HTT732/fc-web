<?php

namespace App\Services\Admin;

use Illuminate\Http\Request;
use App\Repositories\Slider\SliderRepository;
use App\Traits\ImageManipulation;

/**
 * Service SliderService
 *
 * @package App\Services\SliderService
 * @author HTT
 */
Class SliderService
{
    use ImageManipulation;

    public function __construct(
        SliderRepository $sliderRepo
    ){
        $this->sliderRepo = $sliderRepo;
    }

    /**
     * Get all slide
     *
     * @return Collection
     */
    public function getSliders()
    {
        return $this->sliderRepo->getAllSlider();
    }

    public function delete($id)
    {
        $banner = $this->sliderRepo->findByid($id);

        if (!$banner) {
            return false;
        }

        $deleteDB = $this->sliderRepo->delete($id);

        if (!$deleteDB) {
            return false;
        }

        if ($this->deleteImageUpload($banner->original_url)
            && $this->deleteImageUpload($banner->small_url)) {
                return true;
        }

        return false;
    }

    public function uploadFile($files)
    {
        // get info image
        $rootFolder = config('constants.upload.banner.root');
        $listSize = config('constants.upload.banner.size');

        if (!$rootFolder || !$listSize) {
            return false;
        }

        $data = [];
        foreach ($files as $file) {
            $result = $this->processUploadImage($file, $rootFolder, $listSize);
            if ($result['msgCode'] === 400) {
                return false;
            }

            array_push($data, $result);
        }

        // add data
        $input = [];
        foreach ($data as $val) {
            $temp['original_url'] = $val['image']['original'];
            $temp['small_url'] = $val['image']['small'];
            $temp['created_at'] = now();
            $temp['updated_at'] = now();
            
            array_push($input, $temp);
        }

        if(!empty($input)) {
            $add = $this->sliderRepo->createMany($input);

            if (!$add) {
                return false;
            }
        }
        
        return true;
    }

}