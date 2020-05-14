<?php

namespace Owlcoder\CmsShop\Models;

use App\BaseModel;

/**
 *  Class \Owlcoder\CmsShop\Models\ProductCategory
 *  @property  Product[] $products
 */
class ProductCategory extends BaseModel
{
    protected $table = 'product_category';

    public function products()
    {
        return $this->hasManyThrough(Product::class, ProductCategoryBinding::class,
            'product_id',
            'id',
            'id',
            'category_id');
    }
}
