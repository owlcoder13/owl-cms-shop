<?php

namespace Owlcoder\CmsShop\Models;

use App\BaseModel;

/**
 *  Class \Owlcoder\CmsShop\Models\Sku
 * @property SkuAttribute[] $attributes
 */
class Sku extends BaseModel
{
    protected $table = 'sku';

    public function attrs()
    {
        return $this->hasMany(SkuAttribute::class, 'sku_id');
    }

    public function delete()
    {
        foreach ($this->attrs as $one) {
            $one->delete();
        }
        return parent::delete();
    }
}
