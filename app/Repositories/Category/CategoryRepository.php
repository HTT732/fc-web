<?php

namespace App\Repositories\Category;

use App\Models\Category;
use App\Repositories\RepositoryAbstract;

/**
 * Repository CaregoryRepositories
 *
 * @package App\Repositories\Category
 * @author HTT
 */
Class CategoryRepository extends RepositoryAbstract implements CategoryRepositoryInterface
{
    /**
     * Get model name
     *
     * @return Class
     */
    public function getModel()
    {
        return Category::class;
    }

    /**
     * Get categories
     *
     * @return Collection
     */
    public function getAllCategory()
    {
        return $this->all();
    }

    public function getCategoryActive()
    {
        return $this->model->where('active', 1)->get();
    }

    /**
     * Get categories by slug
     *
     * @return Collection
     */
    public function getDataBySlug($slug)
    {
        return $this->model->where('slug', $slug)->first();
    }

    public function create($data)
    {
        return $this->model->create($data);
    }
}