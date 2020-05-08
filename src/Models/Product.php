<?php

namespace Owlcoder\CmsShop\Models;

use App\BaseModel;

/**
 *  Class \Owlcoder\CmsShop\Models\Product
 * @property ProductType $productType
 * @property array $params
 * @property Sku[] $skus
 *
 */
class Product extends BaseModel
{
    protected $table = 'product';

    public function productType()
    {
        return $this->belongsTo(ProductType::class, 'product_type_id');
    }

    public function getParamsAttribute($extended = false)
    {
        $out = [];

        $pt = ProductType::find($this->product_type_id);

        if ($pt == null) {
            return $out;
        }

        foreach ($pt->params as $attribute) {

            if ($extended) {
                $out[$attribute->slug] = [];
                $attributes = ProductAttribute::where('product_type_param_id', $attribute->id)->get();
                /** @var ProductAttribute $one */
                foreach ($attributes as $one) {
                    $out[$attribute->slug][] = [
                        'id' => $one->id,
                        'slug' => $one->attributeItem->slug,
                    ];
                }
            } else {
                $ids = ProductAttribute::where('product_type_param_id', $attribute->id)->pluck('attribute_item_id');
                $out[$attribute->slug] = $ids;
            }

        }

        return $out;
    }

    public function skus()
    {
        return $this->hasMany(Sku::class, 'product_id');
    }

    public function productImages()
    {
        return $this->hasMany(ProductImage::class, 'product_id');
    }
}
