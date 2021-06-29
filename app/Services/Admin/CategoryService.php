<?php

namespace App\Services\Admin;

use Illuminate\Http\Request;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\Product\ProductRepositoryInterface;
use Illuminate\Support\Str;
/**
 * Service CategoryServics
 *
 * @package App\Services\CategoryService
 * @author HTT
 */
Class CategoryService
{
    public function __construct(
        CategoryRepositoryInterface $cateRepo,
        ProductRepositoryInterface $productRepo
    ){
        $this->cateRepo = $cateRepo;
        $this->productRepo = $productRepo;
    }

    /**
     * Get all categories
     *
     * @return Collection
     */
    public function getCategories()
    {
        return $this->cateRepo->getAllCategory();
    }

    public function getCategoryActive()
    {
        return $this->cateRepo->getCategoryActive();
    }

    public function create($request)
    {
        $data = [
            'name' => $request->name,
            'slug' => Str::slug($request->name, '-'),
            'active' => $request->active ? true : false
        ];

        return $this->cateRepo->create($data);
    }

    public function findById($id)
    {
        return $this->cateRepo->findById($id);
    }

    public function update($request, $id)
    {
        $data = $request->only(['name', 'active']);
        $data['slug'] = Str::slug($data['name']);

        return $this->cateRepo->update($data, $id);
    }

    public function delete($id)
    {
        return $this->cateRepo->delete($id);
    }
}