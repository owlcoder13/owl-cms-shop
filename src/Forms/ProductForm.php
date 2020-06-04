<?php

namespace Owlcoder\CmsShop\Forms;

use Owlcoder\CmsShop\Forms\Fields\ProductPhotosField;
use Owlcoder\CmsShop\Models\AttributeItem;
use Owlcoder\CmsShop\Models\Product;
use Owlcoder\CmsShop\Models\ProductAttribute;
use Owlcoder\CmsShop\Models\ProductCategory;
use Owlcoder\CmsShop\Models\ProductCategoryBinding;
use Owlcoder\CmsShop\Models\ProductType;
use Owlcoder\CmsShop\Models\ProductTypeParam;
use Owlcoder\Forms\Fields\DivField;
use Owlcoder\Forms\Fields\EditorField;
use Owlcoder\Forms\Fields\ManyToManyCheckboxListField;
use Owlcoder\Forms\Fields\SelectField;
use Owlcoder\Forms\Form;

class ProductForm extends Form
{
    public function getFields()
    {
        $fields = [
            'name',
            'description' => ['class' => EditorField::class],
            'code',
            'slug',
            'category_id' => [
                'nullIfEmpty' => true,
                'class' => SelectField::class,
                'options' => [null => null] + ProductCategory::all()->pluck('name', 'id')->toArray(),
            ],
            'product_type_id' => [
                'nullIfEmpty' => true,
                'class' => SelectField::class,
                'options' => [null => null] + ProductType::all()->pluck('name', 'id')->toArray(),
            ],
            [
                'middleAttribute' => 'productCategoryBindings',
                'remoteModel' => ProductCategory::class,
                'middleModel' => ProductCategoryBinding::class,
                'toLocalKey' => 'product_id',
                'toRemoteKey' => 'category_id',
                'attribute' => 'categories',
                'class' => ManyToManyCheckboxListField::class,
            ],
        ];

        if ( ! empty($this->instance->id)) {
            $fields['productPhotos'] = [
                'attribute' => 'productPhotos',
                'class' => ProductPhotosField::class,
            ];
            $fields['attributes'] = [
                'fetchData' => function ($field) {
                    $product = $field->instance;
                    $field->value = $product->params;
                },
                'canApply' => false,
                'afterSave' => function ($field) {

                    /** @var Product $product */
                    $product = $field->instance;

                    $oldValue = $product->productAttributes;
                    $data = json_decode($field->value, true);
                    $saved = [];

                    foreach ($data as $slug => $ids) {
                        foreach ($ids as $id) {
                            $ptp = ProductTypeParam::where('slug', $slug)->first();
                            $attributes = [
                                'product_type_param_id' => $ptp->id,
                                'attribute_item_id' => $id,
                                'product_id' => $product->id,
                            ];

                            $productAttribute = ProductAttribute::where($attributes)->first();
                            if ($productAttribute == null) {
                                $productAttribute = new ProductAttribute($attributes);
                                $productAttribute->save();
                            }
                            $saved[] = $productAttribute->id;
                        }
                    }

                    foreach ($oldValue as $one) {
                        if ( ! in_array($one->id, $saved)) {
                            $one->delete();
                        }
                    }
                },
                'getInputAttributes' => function ($field) {
                    $data = array_map(function (ProductTypeParam $item) {
                        return [
                            'slug' => $item->slug,
                            'id' => $item->id,
                            'name' => $item->name,
                            'items' => array_map(function (AttributeItem $item) {
                                return [
                                    'id' => $item->id,
                                    'name' => $item->name,
                                ];
                            }, iterator_to_array($item->attribute->items))
                        ];
                    }, iterator_to_array($field->instance->productType->productTypeParams));

                    return [
                        'data-attributes' => json_encode($data),
                    ];
                },
                'class' => DivField::class,
                'func' => 'productAdminAttributes'
            ];

            //            $fields['skus'] = [
            //                'class' => DivField::class,
            //                'func' => 'productAdminSkus',
            //                'canApply' => false,
            //                'getInputAttributes' => function ($field) {
            //                    $product = $field->instance;
            //
            //                    return [
            //                        'data-selected-params' => json_encode($product->getSkuParams()),
            //                    ];
            //                },
            //
            //                'fetchData' => function ($field) {
            //                    $data = Sku::with('skuAttributes')->where('product_id', $field->instance->id)->get()->toArray();
            //                    $field->value = $data;
            //                },
            //
            //                'afterSave' => function ($field) {
            //
            //                }
            //            ];
        }

        return $fields;
    }

    public function rules()
    {
        return [
            ['product_type_id', 'required'],
        ];
    }

    public function afterSave()
    {
        parent::afterSave();
        $this->instance->generateSkus();
    }
}
