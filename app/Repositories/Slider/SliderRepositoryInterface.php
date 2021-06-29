<?php
namespace App\Repositories\Slider;

use App\Repositories\RepositoryInterface;

/**
 * Interface ProductRepositoryInterface
 *
 * @package App\Repositories
 */
interface SliderRepositoryInterface extends RepositoryInterface
{
    /**
     * Get sliders
     *
     * @return Collection
     */
    public function getAllSlider();
}
