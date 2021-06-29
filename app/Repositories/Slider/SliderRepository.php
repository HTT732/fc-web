<?php

namespace App\Repositories\Slider;

use App\Models\Slider;
use App\Repositories\RepositoryAbstract;
use App\Repositories\Slider\SliderRepositoryInterface;

/**
 * Repository SliderRepositories
 *
 * @package App\Repositories
 * @author HTT
 */
Class SliderRepository extends RepositoryAbstract implements SliderRepositoryInterface
{
    /**
     * Get model name
     *
     * @return Class
     */
    public function getModel()
    {
        return Slider::class;
    }

    /**
     * Get sliders
     *
     * @return Collection
     */
    public function getAllSlider()
    {
        return $this->model->all();
    }
}