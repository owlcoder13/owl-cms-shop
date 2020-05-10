<?php

namespace Owlcoder\CmsShop\Helpers;

use \Route;

class CmsShopRoute
{
    public static function RegisterAdminRoutes()
    {
        Route::group([
            'prefix' => '/admin',
            'middleware' => 'admin',
        ], function () {
            Route::get('/shop', '\Owlcoder\CmsShop\Controllers\Admin\DefaultController@index');

            Route::get('/shop/product-type', '\Owlcoder\CmsShop\Controllers\Admin\ProductTypeController@index')->name('cms-shop.product-type.index');
            Route::any('/shop/product-type/create', '\Owlcoder\CmsShop\Controllers\Admin\ProductTypeController@create')->name('cms-shop.product-type.create');
            Route::any('/shop/product-type/{id}/update', '\Owlcoder\CmsShop\Controllers\Admin\ProductTypeController@update')->name('cms-shop.product-type.update');
            Route::get('/shop/product-type/{id}/delete', '\Owlcoder\CmsShop\Controllers\Admin\ProductTypeController@delete')->name('cms-shop.product-type.delete');

            Route::get('/shop/attribute', '\Owlcoder\CmsShop\Controllers\Admin\AttributeController@index')->name('cms-shop.attribute.index');
            Route::any('/shop/attribute/create', '\Owlcoder\CmsShop\Controllers\Admin\AttributeController@create')->name('cms-shop.attribute.create');
            Route::any('/shop/attribute/{id}/update', '\Owlcoder\CmsShop\Controllers\Admin\AttributeController@update')->name('cms-shop.attribute.update');
            Route::get('/shop/attribute/{id}/delete', '\Owlcoder\CmsShop\Controllers\Admin\AttributeController@delete')->name('cms-shop.attribute.delete');

            Route::get('/shop/product-category', '\Owlcoder\CmsShop\Controllers\Admin\ProductCategoryController@index')->name('cms-shop.product-category.index');
            Route::any('/shop/product-category/create', '\Owlcoder\CmsShop\Controllers\Admin\ProductCategoryController@create')->name('cms-shop.product-category.create');
            Route::any('/shop/product-category/{id}/update', '\Owlcoder\CmsShop\Controllers\Admin\ProductCategoryController@update')->name('cms-shop.product-category.update');
            Route::get('/shop/product-category/{id}/delete', '\Owlcoder\CmsShop\Controllers\Admin\ProductCategoryController@delete')->name('cms-shop.product-category.delete');

            Route::get('/shop/product', '\Owlcoder\CmsShop\Controllers\Admin\ProductController@index')->name('cms-shop.product.index');
            Route::any('/shop/product/create', '\Owlcoder\CmsShop\Controllers\Admin\ProductController@create')->name('cms-shop.product.create');
            Route::any('/shop/product/{id}/update', '\Owlcoder\CmsShop\Controllers\Admin\ProductController@update')->name('cms-shop.product.update');
            Route::get('/shop/product/{id}/delete', '\Owlcoder\CmsShop\Controllers\Admin\ProductController@delete')->name('cms-shop.product.delete');

            // get attributes for current product type
            Route::get('/shop/product/{id}/product-attributes', '\Owlcoder\CmsShop\Controllers\Admin\ProductController@productAttributes');
            Route::get('/shop/product/{id}/skus', '\Owlcoder\CmsShop\Controllers\Admin\ProductController@skus');

        });
    }
}
