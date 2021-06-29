<?php

namespace App\Repositories\User;

use App\Models\User;
use App\Repositories\RepositoryAbstract;
use App\Repositories\User\UserRepositoryInterface;

/**
 * Repository UserRepository
 *
 * @package App\Repositories
 * @author HTT
 */
Class UserRepository extends RepositoryAbstract implements UserRepositoryInterface
{
    /**
     * Get model name
     *
     * @return Class
     */
    public function getModel()
    {
        return User::class;
    }

    public function getAdmin()
    {
        return $this->model->first();
    }
}