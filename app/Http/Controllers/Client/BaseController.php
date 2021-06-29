<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * Class BaseController
 *
 * @package App\Http\Controllers\Client
 */
class BaseController extends Controller
{
    /**
     * Global property and variable limit
     *
     * @var int
     */
    protected $limit;

    /**
     * Global property and variable related product limit
     *
     * @var int
     */
    protected $related_product_limit;

    /**
     * Function constructor
     *
     * @param
     * @return void
     */
    public function __construct()
    {
        $this->limit = config('constants.client.per_page');
        $this->related_product_limit = config('constants.client.related_product');
    }
}
