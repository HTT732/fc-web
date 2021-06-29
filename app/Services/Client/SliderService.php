<?php

namespace App\Services\Client;

use Illuminate\Http\Request;
use App\Repositories\Slider\SliderRepository;

/**
 * Service SliderService
 *
 * @package App\Services\SliderService
 * @author HTT
 */
Class SliderService
{
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
    public function getSliers()
    {
        return $this->sliderRepo->getAllSlider();
    }

}