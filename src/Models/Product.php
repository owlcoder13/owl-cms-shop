<?php

namespace Owlcoder\CmsShop\Models;

use App\BaseModel;

/**
 *  Class \Owlcoder\CmsShop\Models\Product
 * @property ProductType $productType
 * @property array $params
 * @property Sku[] $skus
 * @property ProductAttribute[] $productAttributes
 * @property AttributeItem[] $attributeItems
 *
 */
class Product extends BaseModel
{
    protected $table = 'product';

    public function productType()
    {
        return $this->belongsTo(ProductType::class, 'product_type_id');
    }

    public function attributeItems()
    {
        return $this->hasManyThrough(
            AttributeItem::class,
            ProductAttribute::class,
            'product_id',
            'id',
            'id',
            'attribute_item_id'
        );
    }

    public function productAttributes()
    {
        return $this->hasMany(ProductAttribute::class, 'product_id');
    }

    public function getProductTypeAttributesAttribute()
    {
        return $this->productType->productTypeParams;
    }

    public function getParamsAttribute($extended = false)
    {
        $out = [];

        $params = $this->productType->productTypeParams ?? [];

        foreach ($params as $ptParam) {

            if ($extended) {
                $out[$ptParam->slug] = [];
                $ptParams = ProductAttribute::where('product_type_param_id', $ptParam->id)->get();
                /** @var ProductAttribute $one */
                foreach ($ptParams as $one) {
                    $out[$ptParam->slug][] = [
                        'id' => $one->id,
                        'slug' => $one->attributeItem->slug,
                    ];
                }
            } else {
                $ids = ProductAttribute::where('product_type_param_id', $ptParam->id)->pluck('attribute_item_id');
                $out[$ptParam->slug] = $ids;
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

    /**
     * @param $all
     * @param array $item
     * @param array $handledGroups
     */
    public function generateSkus($item = [], $handledGroups = [])
    {
        $all = $this->productType->productTypeParams;

        $out = [];

        foreach ($all as $groupKey => $attrGroup) {

            if ($attrGroup->type != ProductTypeParam::TYPE_USE_SKU) {
                continue;
            }

            if (in_array($groupKey, $handledGroups)) continue;
            $handledGroups[] = $groupKey;

            foreach ($attrGroup->attribute->items as $attributeItem) {
                $item[$groupKey] = $attributeItem->slug;
                $this->generateSkus($item, $handledGroups);

                if (count($item) == count($all)) {
                    $out[] = $item;
                }
            }
        }

        return $out;
    }
}
