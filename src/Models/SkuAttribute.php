<?php

namespace Owlcoder\CmsShop\Models;

use App\BaseModel;

/**
 *  Class \Owlcoder\CmsShop\Models\SkuAttribute */
class SkuAttribute extends BaseModel
{
    public function param()
    {
        return $this->belongsTo(ProductTypeParam::class, 'product_type_param_id');
    }
}
