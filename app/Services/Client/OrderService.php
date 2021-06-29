<?php

namespace App\Services\Client;

use Illuminate\Http\Request;
use App\Repositories\ProductOrder\ProductOrderRepositoryInterface;
use App\Repositories\OrderDetail\OrderDetailRepositoryInterface;
use Str;
use Cookie;

/**
 * Service CategoryServics
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

    public function order($id, $quanlity)
    {
        $token = Cookie::get('order_token');
        if (!$token) {
            $token = Str::random(64);
            makeCookie('order_token', $token, request()->gethost());
        }

        $order = [
            'product_id' => $id,
            'order_token'=> $token
        ];

        $orderProduct = $this->productOrderRepo->orderExists($order);

        // if exists then update
        if ($orderProduct == null) {
            $orderDetail = [
                'quanlity' => $quanlity
            ];

            $result = $this->orderDetailRepo->create($orderDetail);

            $order['order_id'] = $result->id ?? '';

            $order = $this->productOrderRepo->addOrder($order);
        } else {
            if ($quanlity <= $orderProduct->order->quanlity) {
                $quanlity = $orderProduct->order->quanlity + 1;
            }

            $orderDetail = [
                'quanlity' => $quanlity,
                'order_id' => $orderProduct->order_id
            ];
            $this->orderDetailRepo->updateOrderDetail($orderDetail);
        }

        if (!$order) {
            return [];
        }
        return $order;
    }

    public function deleteOrder($token, $id)
    {
        if (empty($token) || empty($id)) {
            return false;
        }

        $order = $this->productOrderRepo->deleteOrder($token, $id);
    }

    public function update($request)
    {
        foreach($request->data as $order) {
            $chk = $this->orderDetailRepo->updateOrderDetail($order);
            
            if (!$chk)
                return false;                
        }

        return true;
    }

    public function updateUserInfo($request)
    {
        $user = $request->only(['customer_name', 'customer_phone', 'customer_address', 'customer_note']);
        $order_id = $this->productOrderRepo->getOrderId($request->order_token);
        
        if (empty($order_id)) {
            return false;
        }

        $update = $this->orderDetailRepo->updateUserInfo($user, $order_id);

        $data = ['active'=>1];
        $active = $this->activeOrder($data, $request->order_token);

        if ($update && $active) {
            return true;
        }
        return false;
    }

    public function activeOrder($data, $token)
    {
        $active = $this->productOrderRepo->active($data, $token);
        if ($active)
            return true;
        return false;
    }
}