<?php

namespace Owlcoder\CmsShop\Providers;

use Illuminate\Support\ServiceProvider;

class CmsShopProvider extends ServiceProvider
{
    public function register()
    {
        parent::register();

        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'cms-shop');

        app('admin-menu')->add([
            'name' => 'Типы товаров',
            'url' => '/admin/shop/product-type/',
        ]);
        app('admin-menu')->add([
            'name' => 'Товары',
            'url' => '/admin/shop/product/',
        ]);
        app('admin-menu')->add([
            'name' => 'Аттрибуты',
            'url' => '/admin/shop/attribute/',
        ]);
        app('admin-menu')->add([
            'name' => 'Категории товаров',
            'url' => '/admin/shop/product-category/',
        ]);
    }
}
