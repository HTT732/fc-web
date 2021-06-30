<?php

namespace App\Repositories\ProductOrder;

use App\Models\ProductOrder;
use App\Repositories\RepositoryAbstract;
use App\Repositories\ProductOrder\ProductOrderRepositoryInterface;
use App\Models\Order;
use DB;

/**
 * Repository SliderRepositories
 *
 * @package App\Repositories
 * @author HTT
 */
Class ProductOrderRepository extends RepositoryAbstract implements ProductOrderRepositoryInterface
{
    /**
     * Get model name
     *
     * @return string
     */
    public function getModel()
    {
        return ProductOrder::class;
    }

    public function addOrder($order)
    {
        $data = [
            'order_id' => $order['order_id'],
            'order_number' => $this->lastNumberOrder($order['order_token']),
            'product_id' => $order['product_id'],
            'order_token' => $order['order_token']
        ];
        
        return $this->model->create($data);
    }

    public function lastNumberOrder($token = '')
    {
        $currentOrder = $this->model->where('order_token', $token)->first();

        if($currentOrder) {
            return $currentOrder->order_number;
        }

        $last = $this->model->orderBy('order_number', 'desc')->first();

        if (!$last) {
            return 1;
        }

        return $last->order_number + 1;
    }

    public function orderExists($order)
    {
        return $this->model->whereProductID($order['product_id'])
                        ->whereToken($order['order_token'])->with('order')->first();
    }

    public function deleteOrder($order, $id)
    {
        $order = $this->model->where('order_token', $order)
                            ->where('product_id', $id)
                            ->first();
        if ($order) {
            $detail = Order::find($order->order_id)->delete();
            if ($detail) {
                return $order->delete();
            }
            return false;
        }
        return false;
    }

    public function getOrderId($token)
    {
        return $this->model->where('order_token', $token)->pluck('order_id');
    }

    public function getAllOrder()
    {
        dd($this->model->get()->toArray());
        return $this->model->join('products','product_orders.product_id','=','products.id')
                            ->join('orders','product_orders.order_id','=','orders.id')
                            ->groupBy('product_orders.order_token', 'product_orders.order_number')
                            ->orderBy('product_orders.order_number','DESC')
                            ->where('product_orders.active', '>', 0)
                            ->select(
                                DB::raw(
                                    'max(product_orders.created_at) as date,
                                     max(product_orders.active) as active,
                                     max(product_orders.order_number) as order_number,
                                     max(product_orders.order_token) as order_token,
                                     max(products.name) as product_name,
                                     max(orders.customer_name) as customer_name,
                                     sum(products.price * orders.quanlity) as total'
                               )
                            );
    }

    public function getOrderByToken($token)
    {
        return $this->model->with(['order', 'product'])
                            ->where('order_token', $token)
                            ->get();
    }

    public function deleteOrderByToken($token)
    {
        $order = $this->model->where('order_token', $token);
        $orderId = $order->pluck('order_id');
        if ($orderId) {
            $check = true;
            foreach ($orderId as $id) {
                $check = Order::find($id)->delete() ?? false;
                if (!$check)
                    return false;
            }
            return $check;
        }

        return false;
    }

    public function active($data, $token)
    {
        return $this->model->where('order_token', $token)->update($data);
    }
}