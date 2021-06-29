<?php

namespace App\Repositories\OrderDetail;

use App\Models\Order;
use App\Repositories\RepositoryAbstract;
use App\Repositories\OrderDetail\OrderDetailRepositoryInterface;

/**
 * Repository SliderRepositories
 *
 * @package App\Repositories
 * @author HTT
 */
Class OrderDetailRepository extends RepositoryAbstract implements OrderDetailRepositoryInterface
{
    /**
     * Get model name
     *
     * @return string
     */
    public function getModel()
    {
        return Order::class;
    }

    public function create($orderDetail)
    {
        return $this->model->create($orderDetail);
    }

    public function updateOrderDetail($order)
    {
        return $this->model->where('id', $order['order_id'])->update(['quanlity'=>$order['quanlity']]);
    }

    public function updateUserInfo($user, $order_id)
    {
        return $this->model->whereIn('id', $order_id)->update($user);
    }
}