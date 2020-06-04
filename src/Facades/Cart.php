<?php

namespace Owlcoder\CmsShop\Facades;

use Illuminate\Support\Facades\Facade;

class Cart extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Owlcoder\CmsShop\Services\CartService::class;
    }
}



