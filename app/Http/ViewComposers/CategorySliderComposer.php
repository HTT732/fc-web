<?php
 namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Models\Category;
use App\Models\Slider;
use App\Models\ProductOrder;
use Cookie;

 class CategorySliderComposer
 {
     public $data;

     /**
      * Create a view composer.
      *
      * @return void
      */
     public function __construct()
     {
        $product_orders = [];
        if (Cookie::get('order_token')) {
            $product_orders = ProductOrder::with(['product','order'])
                                            ->where('order_token', Cookie::get('order_token'))
                                            ->get();
        }
        $this->data = [
            'categories' => Category::active()->get(),
            'sliders' => Slider::all(),
            'product_orders' => $product_orders
        ];
     }

     /**
      * Bind data to the view.
      *
      * @param  View  $view
      * @return void
      */
     public function compose(View $view)
     {

         $view->with('data', $this->data);
     }
 }
