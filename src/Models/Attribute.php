<?php

namespace Owlcoder\CmsShop\Models;

use App\BaseModel;

/**
 *  Class \Owlcoder\CmsShop\Models\Attribute
 *  @property AttributeItem[] $items
 */
class Attribute extends BaseModel
{
    protected $table = 'attribute';

    public function items()
    {
        return $this->hasMany(AttributeItem::class, 'attribute_id');
    }
}
