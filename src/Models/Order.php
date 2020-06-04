<?php

namespace Owlcoder\CmsShop\Models;

use App\BaseModel;

/**
 *  Class \Owlcoder\CmsShop\Models\Order */
class Order extends BaseModel
{
    protected $table = 'order';

    const STATUS_CART = 10;

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'order_id');
    }
}
