<?php

namespace Owlcoder\CmsShop\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Owlcoder\CmsShop\Models\Cart;
use Owlcoder\CmsShop\Models\Order;
use Owlcoder\CmsShop\Models\OrderItem;

class CartService
{
    public $request;
    public $hash;
    public $cookieName = 'cHash';

    public $order;

    public function __construct(Request $request)
    {
        $this->request = $request;

        $hash = $request->cookies->get($this->cookieName, null);
        if (empty($hash)) {
            $hash = Hash::make(uniqid(true));
        }

        $this->hash = $hash;
        $this->order = Order::where('user_hash', $this->hash)->first();

        if (empty($this->cartModel)) {
            $this->order = new Order();
            $this->order->user_hash = $this->hash;
            $this->order->status = Order::STATUS_CART;

        }
    }

    /**
     * @return OrderItem[]
     */
    public function getItems()
    {
        return $this->order->orderItems;
    }

    public function countItems(){
        return $this->order->orderItems->count();
    }

    public function addItem($item_id, $cnt)
    {

    }

    public function increase()
    {

    }

    public function decrease()
    {

    }

    public function removeItem()
    {

    }

    /**
     * @return CartService $this
     */
    public function current()
    {
        return $this;
    }

    public function firstOrder()
    {
        return $this->cartModel->orders[0];
    }
}
