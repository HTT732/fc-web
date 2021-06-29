<?php
namespace App\Repositories\OrderDetail;

use App\Repositories\RepositoryInterface;

/**
 * Interface OrderDetailRepositoryInterface
 *
 * @package App\Repositories
 */
interface OrderDetailRepositoryInterface extends RepositoryInterface
{
    public function create($orderDetail);
}
