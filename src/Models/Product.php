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

    public function productCategoryBindings()
    {
        return $this->hasMany(ProductCategoryBinding::class, 'product_id');
    }

    public function categories()
    {
        return $this->hasManyThrough(
            ProductCategory::class,
            ProductCategoryBinding::class,
            'product_id',
            'id',
            'id',
            'category_id',
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

    public function getSkuParams()
    {
        $out = [];

        foreach ($this->productType->productTypeParams as $ptParam) {
            if ($ptParam->type == ProductTypeParam::TYPE_USE_SKU) {
                $items = [];

                /** @var ProductAttribute[] $productAttributes */
                $productAttributes = ProductAttribute::where('product_type_param_id', $ptParam->id)->get();

                foreach ($productAttributes as $one) {
                    $items[] = [
                        'id' => $one->attributeItem->id,
                        'name' => $one->attributeItem->name,
                        'slug' => $one->attributeItem->slug,
                    ];
                }

                $out[] = [
                    'items' => $items,
                    'name' => $ptParam->attribute->name,
                    'slug' => $ptParam->attribute->slug,
                ];
            }
        }

        return $out;
    }

    public function getParamsAttribute($extended = false)
    {
        $out = [];
        foreach ($this->productType->productTypeParams as $ptParam) {
            $ids = ProductAttribute::where('product_type_param_id', $ptParam->id)->pluck('attribute_item_id');
            $out[$ptParam->slug] = $ids->toArray();
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
    public function collectSkuVariants($item = [], $handledGroups = [])
    {
        $selected = $this->params;
        $all = ProductTypeParam::where('product_type_id', $this->product_type_id)
            ->where('type', ProductTypeParam::TYPE_USE_SKU)->get();
        $allCount = $all->count();

        $out = [];

        foreach ($all as $attrGroup) {

            if (in_array($attrGroup->slug, $handledGroups)) continue;
            $handledGroups[] = $attrGroup->slug;

            foreach ($attrGroup->attribute->items as $attributeItem) {

                $localItem = array_merge($item);

                $slug = $attributeItem->slug;
                if ( ! in_array($attributeItem->id, $selected[$attrGroup->slug])) {
                    continue;
                }

                $localItem[$attrGroup->slug] = $attributeItem->slug;
                $out = array_merge($out, $this->collectSkuVariants($localItem, $handledGroups));

                if (count($localItem) == $allCount) {
                    $out[] = $localItem;
                }
            }
        }

        return $out;
    }

    /**
     * Создать все виды sku
     */
    public function generateSkus()
    {
        $variants = $this->collectSkuVariants();

        foreach ($variants as $variant) {

            $query = \App\Models\Sku::where('product_id', $this->id);

            foreach ($variant as $key => $value) {
                $productTypeParam = ProductTypeParam::where('slug', $key)->first();
                $ai = AttributeItem::where('slug', $value)->first();

                $query->whereHas('attrs', function ($q) use ($ai, $productTypeParam) {
                    $q->where('product_type_param_id', $productTypeParam->id);
                    $q->where('attribute_item_id', $ai->id);
                });
            }

            $query->has('attrs', '=', count($variant));

            $sku = $query->first();

            if ($sku == null) {
                $sku = new \App\Models\Sku();
                $sku->product_id = $this->id;
                $sku->save();

                foreach ($variant as $key => $value) {
                    $ai = AttributeItem::where('slug', $value)->first();
                    $productTypeParam = ProductTypeParam::where('slug', $key)->first();

                    $sa = new SkuAttribute();
                    $sa->sku_id = $sku->id;
                    $sa->product_type_param_id = $productTypeParam->id;
                    $sa->attribute_item_id = $ai->id;
                    $sa->save();
                }
            }
        }


    }

}
