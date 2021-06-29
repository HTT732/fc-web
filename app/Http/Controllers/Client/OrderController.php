<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Client\OrderService;
use Cookie;

class OrderController extends BaseController
{
    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function order($id, $quanlity = 1)
    {
        $orders = $this->orderService->order($id, $quanlity);

        return back()->with('add_to_cart', __('messages.add_to_cart'));
    }

    public function destroy($token, $id, Request $request)
    {
        $check = $this->orderService->deleteOrder($token, $id);

        if($request->ajax()) {
            return $check;
        }

        return back();
    }

    public function update(Request $request)
    {
        return $this->orderService->update($request);
    }
}
