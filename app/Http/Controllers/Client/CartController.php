<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Client\OrderService;
use App\Http\Requests\CheckoutRequest;
use Cookie;

class CartController extends Controller
{
    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function index(Request $request)
    {
        return view('client.cart.shopping-cart');
    }

    public function showCheckout() {
        return view('client.cart.checkout');
    }

    public function showOrderComplete() {
        return view('client.cart.order-complete');
    }

    public function postCheckout(CheckoutRequest $request) {
        $update = $this->orderService->updateUserInfo($request);

        if (!$update) {
            return back()->withInput()
                        ->with('error_checkout', __('messages.error_checkout'));
        }
        return redirect()->route('order-complete')->withCookie(cookie('order_token',null,0));
    }

}
