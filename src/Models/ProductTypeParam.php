<?php

namespace Owlcoder\CmsShop\Models;

use App\BaseModel;

/**
 *  Class \Owlcoder\CmsShop\Models\ProductTypeParam */
class ProductTypeParam extends BaseModel
{
    const TYPE_DEFAULT = 10;
    const TYPE_USE_SKU = 20;

    protected $table = 'product_type_param';

    public static function ProductTypeParamTypeNames()
    {
        return [
            self::TYPE_DEFAULT => 'По умолчанию',
            self::TYPE_USE_SKU => 'Используется в sku',
        ];
    }

    public function attribute()
    {
        return $this->belongsTo(Attribute::class, 'attribute_id');
    }
}
