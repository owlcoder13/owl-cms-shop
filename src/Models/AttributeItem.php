<?php

namespace Owlcoder\CmsShop\Models;

use App\BaseModel;

/**
 *  Class \Owlcoder\CmsShop\Models\AttributeItem */
class AttributeItem extends BaseModel
{
    protected $table = 'attribute_item';

    public function attribute()
    {
        return $this->belongsTo(Attribute::class, 'attribute_id');
    }
}
