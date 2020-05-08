<?php

namespace Owlcoder\CmsShop\Models;

use App\BaseModel;
use \Owlcoder\CmsShop\Models\Base\BaseProductAttribute;

/**
 *  Class \Owlcoder\CmsShop\Models\ProductAttribute
 * @property Attribute $attribute
 * @property Product product
 * @property AttributeItem $attributeItem
 */
class ProductAttribute extends BaseModel
{
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function attributeItem()
    {
        return $this->belongsTo(AttributeItem::class, 'attribute_item_id');
    }
}
