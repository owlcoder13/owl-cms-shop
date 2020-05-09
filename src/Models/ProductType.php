<?php

namespace Owlcoder\CmsShop\Models;

use App\BaseModel;

/**
 *  Class \Owlcoder\CmsShop\Models\ProductType
 * @property ProductTypeParam[] $productTypeParams
 */
class ProductType extends BaseModel
{
    protected $table = 'product_type';

    public function productTypeParams()
    {
        return $this->hasMany(ProductTypeParam::class, 'product_type_id');
    }

    public function getAttributesAttribute()
    {
        return $this->productTypeParams->pluck('attribute');
    }


}
