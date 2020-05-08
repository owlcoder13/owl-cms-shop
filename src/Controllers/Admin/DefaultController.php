<?php

namespace Owlcoder\CmsShop\Controllers\Admin;

use Illuminate\Routing\Controller;

class DefaultController extends Controller
{
    public function index()
    {
        return view('cms-shop::admin.shop.index');
    }
}
