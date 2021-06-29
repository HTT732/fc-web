<?php
 namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductOrder;
use App\Models\Slider;
use Auth;

 class MenuAdminComposer
 {
     public $data;

     /**
      * Create a view composer.
      *
      * @return void
      */
     public function __construct()
     {
        $productCount = 0;
        $cateCount = 0;
        $orderCount = 0;
        $banner = [];

        if (Auth::check()) {
            $productCount = Product::count();
            $cateCount = Category::count();
            $orderCount = ProductOrder::active()->count();
            $banner = Slider::all();
        }
        $this->data = [
            'productCount' => $productCount,
            'cateCount' => $cateCount,
            'orderCount' => $orderCount,
            'banner' => $banner
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
