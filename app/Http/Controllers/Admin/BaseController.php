<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    /**
     * Global property and variable limit
     *
     * @var int
     */
    protected $limit;

    /**
     * Function constructor
     *
     * @param
     * @return void
     */
    public function __construct()
    {
        $this->limit = config('constants.back_end.per_page');
    }
}
