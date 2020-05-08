<?php

namespace Owlcoder\CmsShop\Helpers;

use \Route;

class CmsShopRoute
{
    public static function RegisterAdminRoutes()
    {
        Route::get('/admin/shop', '\Owlcoder\CmsShop\Controllers\Admin\DefaultController@index');

        Route::get('/admin/shop/product-type', '\Owlcoder\CmsShop\Controllers\Admin\ProductTypeController@index')->name('cms-shop.product-type.index');
        Route::any('/admin/shop/product-type/create', '\Owlcoder\CmsShop\Controllers\Admin\ProductTypeController@create')->name('cms-shop.product-type.create');
        Route::any('/admin/shop/product-type/{id}/update', '\Owlcoder\CmsShop\Controllers\Admin\ProductTypeController@update')->name('cms-shop.product-type.update');
        Route::get('/admin/shop/product-type/{id}/delete', '\Owlcoder\CmsShop\Controllers\Admin\ProductTypeController@delete')->name('cms-shop.product-type.delete');

        Route::get('/admin/shop/product', '\Owlcoder\CmsShop\Controllers\Admin\ProductController@index')->name('cms-shop.product.index');
        Route::any('/admin/shop/product/create', '\Owlcoder\CmsShop\Controllers\Admin\ProductController@create')->name('cms-shop.product.create');
        Route::any('/admin/shop/product/{id}/update', '\Owlcoder\CmsShop\Controllers\Admin\ProductController@update')->name('cms-shop.product.update');
        Route::get('/admin/shop/product/{id}/delete', '\Owlcoder\CmsShop\Controllers\Admin\ProductController@delete')->name('cms-shop.product.delete');

        Route::get('/admin/shop/attribute', '\Owlcoder\CmsShop\Controllers\Admin\AttributeController@index')->name('cms-shop.attribute.index');
        Route::any('/admin/shop/attribute/create', '\Owlcoder\CmsShop\Controllers\Admin\AttributeController@create')->name('cms-shop.attribute.create');
        Route::any('/admin/shop/attribute/{id}/update', '\Owlcoder\CmsShop\Controllers\Admin\AttributeController@update')->name('cms-shop.attribute.update');
        Route::get('/admin/shop/attribute/{id}/delete', '\Owlcoder\CmsShop\Controllers\Admin\AttributeController@delete')->name('cms-shop.attribute.delete');

        Route::get('/admin/shop/product-category', '\Owlcoder\CmsShop\Controllers\Admin\ProductCategoryController@index')->name('cms-shop.product-category.index');
        Route::any('/admin/shop/product-category/create', '\Owlcoder\CmsShop\Controllers\Admin\ProductCategoryController@create')->name('cms-shop.product-category.create');
        Route::any('/admin/shop/product-category/{id}/update', '\Owlcoder\CmsShop\Controllers\Admin\ProductCategoryController@update')->name('cms-shop.product-category.update');
        Route::get('/admin/shop/product-category/{id}/delete', '\Owlcoder\CmsShop\Controllers\Admin\ProductCategoryController@delete')->name('cms-shop.product-category.delete');
    }
}
