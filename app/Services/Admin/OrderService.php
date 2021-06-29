<?php

namespace App\Services\Admin;

use Illuminate\Http\Request;
use App\Repositories\ProductOrder\ProductOrderRepositoryInterface;
use App\Repositories\OrderDetail\OrderDetailRepositoryInterface;
use Str;
use Cookie;

/**
 * Service OrderServics
 *
 * @package App\Services\OrderService
 * @author HTT
 */
Class OrderService
{
    public function __construct(
        ProductOrderRepositoryInterface $productOrderRepo,
        OrderDetailRepositoryInterface $orderDetailRepo
    ){
        $this->productOrderRepo = $productOrderRepo;
        $this->orderDetailRepo = $orderDetailRepo;
    }

    public function getAllOrder($limit = 15)
    {
        $orders = $this->productOrderRepo->getAllOrder();

        if (!$orders->count()) {
            return [];
        }

        return $orders->paginate($limit);

    }
   
    public function getOrderByToken($token)
    {
        if (empty($token))
            return false;

        return $this->productOrderRepo->getOrderByToken($token);
    }

    public function deleteOrderByToken($token = '')
    {
        return $this->productOrderRepo->deleteOrderByToken($token);
    }

    public function activeOrder($data, $token)
    {
        $active = $this->productOrderRepo->active($data, $token);
        if ($active)
            return true;
        return false;
    }

}